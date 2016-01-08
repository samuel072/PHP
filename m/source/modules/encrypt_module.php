<?php

class EncryptModule
{
	const enc_string = 'Ydk@2013#hisoft%magenm~!';

	private $bytekey;

	public function __construct($key) {
		$len = strlen($key);
		if($len > 16) {
			$key = substr($key, 0, 16);
		} else {
			for($i = 0; $i < 16 - $len; $i ++) {
				$key = $key . '0';
			}
		}

		$tmp = unpack('c*', $key);
		for($i = 0; $i < count($tmp); $i ++) {
			$this->bytekey[] = $tmp[$i + 1];
		}
	}

	public static function encrypt($text, $key) {
		if(!$text) {
			return NULL;
		}

		$text = strlen($text) . ':#len#:' . $text;

		$mod = new EncryptModule($key . EncryptModule::enc_string);

		$args = array();
		$tmp = unpack('c*', $text);
		for($i = 0; $i < count($tmp); $i ++) {
			$args[] = $tmp[$i + 1];
		}
		return $mod->idea_encrypt($args);
	}

	public static function decrypt($cipher, $key) {
	}

	// 返回加密的数据
	private function idea_encrypt($data) {
		$format_key = $this->byte_data_format($this->bytekey, 16);
		$format_data = $this->byte_data_format($data, 8);

		$datalen = count($format_data);
		$unitcount = intval($datalen / 8);
		$result_data = $this->array_create($datalen);

		for($i = 0; $i < $unitcount; $i ++) {
			$tmpkey = $this->array_create(16);
			$tmpdata = $this->array_create(8);

			$this->array_copy($format_key, 0, $tmpkey, 0, 16);
			$this->array_copy($format_data, $i * 8, $tmpdata, 0, 8);

			$tmpresult = $this->do_encrypt($tmpkey, $tmpdata);
			$this->array_copy($tmpresult, 0, $result_data, $i * 8, 8);
		}

		return $this->bytes_to_hex($result_data);
	}

	private function do_encrypt($bkey, $input) {
		$keys = $this->encrypt_subkey($bkey);
		return $this->encrypt_block($keys, $input);
	}

	private function encrypt_block($keys, $inbytes) {
		$outbytes = $this->array_create(8);

		$k = 0;
		$a = $this->bytes_to_int($inbytes, 0);
		$b = $this->bytes_to_int($inbytes, 2);
		$c = $this->bytes_to_int($inbytes, 4);
		$d = $this->bytes_to_int($inbytes, 6);

		for($i = 0; $i < 8; $i ++) {
			$a = $this->x_multiply_y($a, $keys[$k ++]);
			$b += $keys[$k ++];
			$b &= 0xffff;
			$c += $keys[$k ++];
			$c &= 0xffff;
			$d = $this->x_multiply_y($d, $keys[$k ++]);

			$tmp1 = $b;
			$tmp2 = $c;
			$c ^= $a;
			$b ^= $d;
			$c = $this->x_multiply_y($c, $keys[$k ++]);
			$b += $c;
			$b &= 0xffff;
			$b = $this->x_multiply_y($b, $keys[$k ++]);
			$c += $b;
			$c &= 0xffff;
			$a ^= $b;
			$d ^= $c;
			$b ^= $tmp2;
			$c ^= $tmp1;
		}

		$this->int_to_bytes($this->x_multiply_y($a, $keys[$k ++]), $outbytes, 0);
		$this->int_to_bytes($c + $keys[$k ++], $outbytes, 2);
		$this->int_to_bytes($b + $keys[$k ++], $outbytes, 4);
		$this->int_to_bytes($this->x_multiply_y($d, $keys[$k]), $outbytes, 6);

		return $outbytes;
	}

	private function encrypt_subkey($bkey) {
		$key = $this->array_create(52);

		if(count($bkey) < 16) {
			$tmpkey = $this->array_create(16);
			$this->array_copy($bkey, 0, $tmpkey, count($tmpkey) - count($bkey), count($bkey));
			$bkey = $tmpkey;
		}

		for($i = 0; $i < 8; $i ++) {
			$key[$i] = $this->bytes_to_int($bkey, $i * 2);
		}

		for($i = 8; $i < 52; $i ++) {
			if(($i & 0x7) < 6) {
				$key[$i] = ((($key[$i - 7] & 0x7f) << 9) | ($key[$i - 6] >> 7)) & 0xffff;
			} else if(($i & 0x7) == 6) {
				$key[$i] = ((($key[$i - 7] & 0x7f) << 9) | ($key[$i - 14] >> 7)) & 0xffff;
			} else {
				$key[$i] = ((($key[$i - 15] & 0x7f) << 9) | ($key[$i - 14] >> 7)) & 0xffff;
			}
		}

		return $key;
	}

	// 返回8位数据
	private function byte_data_format($data, $unit) {
		$len = count($data);
		$padlen = $unit - ($len % $unit);
		$newlen = $len + $padlen;

		$newdata = $this->array_create($newlen);
		$this->array_copy($data, 0, $newdata, 0, $len);

		for($i = $len; $i < $newlen; $i ++) {
			$newdata[$i] = $padlen;
		}

		return $newdata;
	}

	private function array_create($count) {
		$arr = array();
		for($i = 0; $i < $count; $i ++) {
			$arr[$i] = 0;
		}

		return $arr;
	} 

	private function array_copy($arr1, $start1, &$arr2, $start2, $len) {
		for($i = 0; $i < $len; $i ++) {
			$arr2[$start2 + $i] = $arr1[$start1 + $i];
		}

		return $arr2;
	}

	private function bytes_to_int($inbytes, $start) {
		return (($inbytes[$start] << 8) & 0xff00) + ($inbytes[$start + 1] & 0xff);
	}

	// x, y 都是32位有符号整数
	private function x_multiply_y($x, $y) {
		if($x == 0) {
			$x = 0x10001 - $y;
		} else if($y == 0) {
			$x = 0x10001 - $x;
		} else {
			// 老的悦读客程序此处没有考虑int溢出问题，所以我们要模拟溢出
			$tmp = (($x * $y) & 0xffffffff) | 0xffffffff00000000; 
			$y = $tmp & 0xffff;

			// 模拟无符号右移	
			$x = ($tmp >> 16) & 0xffff;

			$x = ($y - $x) + (($y < $x) ? 1 : 0);
		}

		return $x & 0xffff;
	}

	private function int_to_bytes($int, &$outbytes, $start) {
		$outbytes[$start] = ($int >> 8) & 0xff; //无符号右移
		$outbytes[$start + 1] = $int & 0xff;
	}

	private function bytes_to_hex($bytes) {
		$str = '';
		foreach($bytes as $b) {
			$str .= $this->int16_to_char($b);
		}

		return $str;
	}

	private function int16_to_char($int) {
		$h = intval($int / 16);
		$l = intval($int % 16);

		return $this->int8_to_char($h) . $this->int8_to_char($l);
	}

	private function int8_to_char($int) {
		if($int < 10) {
			return pack('c', $int + 0x30);
		} else {
			return pack('c', $int - 10 + 0x41);
		}
	}
}

?>
