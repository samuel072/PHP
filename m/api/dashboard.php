<?php
    require_once("../config.php");

	header("application/json;charset=utf-8");

	$ch_id_min = 0;
	$adv_id_min = 4000;
	$talk_id_min = 1000;
	$act_id_min = 2000;
	$mooc_id_min = 6000;
	$talker_id_min = 3000;
	$section_id_min = 5000;

	$adv0 = array('id' => $adv_id_min + 1,
				'type' => 0,
				'image' => '/upload/a.jpg',
				'link' => 'http://yike.yueduke.com/index/toApplayPage.do?idTwo=281&signCode=0');	
	$ch_adv = array('id' => $ch_id_min + 1,
					'type' => 0,
					'name' => '新年广告',
					'summary' => '新年来了，K主播为每个人都准备了红包，你的姿势摆好了么？',
					'thumbnail'=>'/upload/a.jpg',
					'tags' => array(),
					'content' => array($adv0));

	$section0 = array('id' => $section_id_min,
			'type' => 0,
			'detail' => "15分钟也许就是记忆几十个英文单词，做一篇阅读理解的时间，然而在近日风靡中国的“一刻演讲”的舞台上，这个瞬间完全可以酝酿出一场观点对撞的头脑风暴，邂逅名家榜样的奇思妙想。\n1月10日，“中国雅思之父”，著名英语教育专家与教学管理专家，新航道国际教育集团创始人兼CEO胡敏教授，登上一刻演讲”舞台，向在场的北京理工大学师生及媒体分享了他投身英语教育培训十年来的不为人知的创业历程和非常境遇，更首次公开透露新航道未来发展规划。\n据悉，“一刻演讲”是由共青团中央学校部指导，北京掌娱互动文化传播有限公司创立及主办演讲项目，以“激赏生命中最特别的15分钟”为口号，旨在分享有价值的思想和故事，鼓励独立思考，力求打造中国版的TED演讲舞台。本次活动是“一刻演讲”全国巡讲的第二场，得到了北京理工大学管理与经济学院MBA教育中心和知名财经自媒体“正和岛”的大力支持，同时受到了广大学子及社会人士的热烈欢迎，胡敏也成为继雷军之后又一位登上这个舞台的重量级嘉宾。",
			'image' => '',
			'act_id' => $talk_id_min + 1,
			'link' => '',
			'num' => 0);

	$section1 = array('id' => $section_id_min + 1,
			'type' => 1,
			'detail' => "",
			'image' => '/upload/a.jpg',
			'act_id' => $talk_id_min + 1,
			'link' => '',
			'num' => 0);

	$section2 = array('id' => $section_id_min + 2,
			'type' => 3,
			'detail' => '雷军演讲视频',
			'image' => '/upload/a.jpg',
			'act_id' => $talk_id_min + 1,
			'link' => 'http://v.youku.com/v_show/id_XODkxMTU1NjU2.html?f=23465710&ev=4&from=y1.3-idx-grid-1519-9909.86808-86807.7-1',
			'num' => 0);

	$talk0 = array('id' => $talk_id_min + 1,
			'type' => 0,
			'title' => '雷军北大一刻演讲',
			'summary' => '四十岁才开始创业，是不是太晚了点？胡敏告诉你：好梦永远不嫌晚！十年，一个人能做什么？新航道告诉你：创办一个大集团，成就几千人的事业，成就百万学子梦想！有生离死别，有中途出走，有失败到谷底，更有雄心如铁，青春追随，雄风猎猎，峰回路转。这是胡敏的故事。',
			'thumbnail' => '/upload/a.jpg',
			'state' => 2,
			'author' => array(),
			'holder' => '一刻',
			'start_time' => '2015-2-04 12:10:00',
			'end_time' => '2015-2-04 18:00:00',
			'address' => '北京海淀中关村大街19号（海淀黄庄）新中关大厦A座12层1201',
			'longitude' => 0.0,
			'latitude' => 0.0,
			'modify_time' => '2015-02-03 10:00:00',
			'tags' => array(),
			'content'=>array($section0, $section1)
	);
	
	$ch_talk = array('id' => $ch_id_min + 2,
			'type' => 1,
			'name' => '胡敏演讲',
			'summary' => '以梦为马，激赏人生，看胡老师如何一次一次的走向人生巅峰',
			'thumbnail'=>'/upload/a.jpg',
			'tags' => array(),
			'content' => array($talk0, $talk0)
	);
	
	$act0 = array('id' => $act_id_min + 1,
			'type' => 1,
			'title' => '雷军北大一刻演讲',
			'summary' => '四十岁才开始创业，是不是太晚了点？胡敏告诉你：好梦永远不嫌晚！十年，一个人能做什么？新航道告诉你：创办一个大集团，成就几千人的事业，成就百万学子梦想！有生离死别，有中途出走，有失败到谷底，更有雄心如铁，青春追随，雄风猎猎，峰回路转。这是胡敏的故事。',
			'thumbnail' => '/upload/a.jpg',
			'state' => 2,
			'author' => array(),
			'holder' => '一刻',
			'start_time' => '2015-2-04 12:10:00',
			'end_time' => '2015-2-04 18:00:00',
			'address' => '北京海淀中关村大街19号（海淀黄庄）新中关大厦A座12层1201',
			'longitude' => 0.0,
			'latitude' => 0.0,
			'modify_time' => '2015-02-03 10:00:00',
			'tags' => array(),
			'content'=>array($section0, $section1)
	);
	
	$ch_act = array('id' => $ch_id_min + 3,
			'type' => 2,
			'name' => '胡敏演讲',
			'summary' => '以梦为马，激赏人生，看胡老师如何一次一次的走向人生巅峰',
			'thumbnail'=>'/upload/a.jpg',
			'tags' => array(),
			'content' => array($act0, $act0, $act0, $act0, $act0)
	);

	$mooc = array('id' => $mooc_id_min + 1,
            'type' => 1,
            'title' => '雷军北大一刻演讲',
            'summary' => '四十岁才开始创业，是不是太晚了点？胡敏告诉你：好梦永远不嫌晚！十年，一个人能做什么？新航道告诉你：创>办一个大集团，成就几千人的事业，成就百万学子梦想！有生离死别，有中途出走，有失败到谷底，更有雄心如铁，青春追随，雄风猎猎，峰回>路转。这是胡敏的故事。',
            'thumbnail' => '/upload/a.jpg',
            'state' => 2,
            'author' => array(),
            'holder' => '一刻',
            'start_time' => '2015-2-04 12:10:00',
            'end_time' => '2015-2-04 18:00:00',
            'address' => '北京海淀中关村大街19号（海淀黄庄）新中关大厦A座12层1201',
            'longitude' => 0.0,
            'latitude' => 0.0,
            'modify_time' => '2015-02-03 10:00:00',
            'tags' => array(),
            'content'=>array($section2)
    );

	$ch_mooc = array('id' => $ch_id_min + 4,
			'type' => 4,
			'name' => '胡敏演讲',
			'summary' => '以梦为马，激赏人生，看胡老师如何一次一次的走向人生巅峰',
			'thumbnail'=>'/upload/a.jpg',
			'tags' => array(),
			'content' => array($mooc, $mooc)
	);

	$talker = array('id' => $talker_id_min,
			'name' => '黄阿能',
			'points' => '1003',
			'image' => 'http://www.yikeyanjiang.com/upload/theOne/0/7/c8a6e030-7299-489e-ab35-1d8fca5fe1eb.jpg'
	);

	$ch_talker = array('id' => $ch_id_min + 5,
			'type' => 3,
			'name' => '胡敏演讲',
			'summary' => '以梦为马，激赏人生，看胡老师如何一次一次的走向人生巅峰',
			'thumbnail'=>'/upload/a.jpg',
			'tags' => array(),
			'content' => array($talker, $talker)
	);

	echo json_encode(array("channels" => array($ch_adv, $ch_talk, $ch_act, $ch_mooc, $ch_talker)));
?>
