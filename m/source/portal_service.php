<?php
require_once(ykfile("source/modules/channel_module.php"));
require_once(ykfile("source/modules/activity_module.php"));
require_once(ykfile("source/modules/talker_module.php"));
require_once(ykfile("source/modules/adv_module.php"));

// 首页门户服务类
class PortalService
{
	private $ch_ids;

	public function __construct() {
		$this->ch_ids = array(PORTAL_ADV_CHANNEL,
					PORTAL_TALK_CHANNEL,
					PORTAL_TALKER_CHANNEL,
					PORTAL_ACTIVITY_CHANNEL);
	}

	public function get_portal_content() {
		$chmod = new ChannelModule();

		$channels = array();
		foreach($this->ch_ids as $cid) {
			$channel = $chmod->get_by_id($cid);

			switch($channel->type) {

			case ChannelModel::channel_type_adv:
				$advmod = new AdvModule();
				$channel->content = $advmod->get_by_channel($cid, 0, 10);
				break;

			case ChannelModel::channel_type_talk:
			case ChannelModel::channel_type_activity:
				$actmod = new ActivityModule();
				$channel->content = $actmod->get_by_channel($cid, 0, 10);
				break;

			case ChannelModel::channel_type_talker:
				$talkermod = new TalkerModule();
				$channel->content = $talkermod->get_by_channel($cid, 0, 10);
				break;
			}

			$channels[] = $channel;
		}

		return $channels;
	}
	
	// 保存首页
	public function save_portal($portal_id, $number, $channel_type) {
		if(!$number){
			$number = 1;
		}
		$result = null;
		switch($channel_type) {
			case ChannelModel::channel_type_adv:
				$advmod = new AdvModule();
				$result = $advmod->update_adv_channel($portal_id, $number, PORTAL_ADV_CHANNEL);
				break;

			case ChannelModel::channel_type_talk: 
				$actmod = new ActivityModule();
				$result = $actmod->update_activity_channel($portal_id, $number, PORTAL_TALK_CHANNEL);
				break;
			case ChannelModel::channel_type_activity:
				$actmod = new ActivityModule();
				$result = $actmod->update_activity_channel($portal_id, $number, PORTAL_ACTIVITY_CHANNEL);
				break;

			case ChannelModel::channel_type_talker:
				$talkermod = new TalkerModule();
				$result = $talkermod->update_talker_channel($portal_id, $number, PORTAL_TALKER_CHANNEL);
				break;
			}
			
			return $result;
			
		}
}
?>
