<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid'])
{
	getLink('','','정상적인 접근이 아닙니다.','');
}

if (!$mbruid) exit;

$M = getUidData($table['s_mbrid'],$mbruid);
if (!$M['uid']) getLink('','','존재하지 않는 회원입니다.','');

$_isFollowing = getDbRows($table['s_friend'],'my_mbruid='.$my['uid'].' and by_mbruid='.$mbruid);

if ($_isFollowing)
{

	$R = getDbData($table['s_friend'],'my_mbruid='.$mbruid.' and by_mbruid='.$my['uid'],'*');
	getDbDelete($table['s_friend'],'my_mbruid='.$my['uid'].' and by_mbruid='.$mbruid);
	getDbUpdate($table['s_friend'],'rel=0','uid='.$R['uid']);
	getDbUpdate($table['s_mbrdata'],'num_follower=num_follower-1','memberuid='.$mbruid);

	// 알림 메시지 전송
	$rcvmember = $mbruid ;
	$sendmodule = $M['id'];
	$sendmember = $my['uid'] ;
	$message = "구독을 취소했습니다";
	$referer = '';
	$target = '_self';
	putNotice($rcvmember,$sendmodule,$sendmember,$title,$message,$referer,$button,$tag,$skip_email,$skip_push);

}
else {

	$R = getDbData($table['s_friend'],'my_mbruid='.$mbruid.' and by_mbruid='.$my['uid'],'*');

	if ($R['uid']) {
		getDbInsert($table['s_friend'],'rel,my_mbruid,by_mbruid,category,d_regis',"'1','".$my['uid']."','".$mbruid."','','".$date['totime']."'");
		getDbUpdate($table['s_friend'],'rel=1','uid='.$R['uid']);
	} else {
		getDbInsert($table['s_friend'],'rel,my_mbruid,by_mbruid,category,d_regis',"'0','".$my['uid']."','".$mbruid."','','".$date['totime']."'");
	}

	getDbUpdate($table['s_mbrdata'],'num_follower=num_follower+1','memberuid='.$mbruid);

	// 알림 메시지 전송
	$rcvmember = $mbruid ;
	$sendmodule = $M['id'];
	$sendmember = $my['uid'] ;
	$message = "구독을 시작했습니다.";
	$referer = '';
	$target = '_self';
	putNotice($rcvmember,$sendmodule,$sendmember,$title,$message,$referer,$button,$tag,$skip_email,$skip_push);

}

$M1 = getDbData($table['s_mbrdata'],'memberuid='.$mbruid,'*');
$num_follower = $M1['num_follower'];
?>


<script>

window.parent.$.notify({

	<?php if ($_isFollowing): ?>
	message: "구독이 취소 되었습니다."
	<?php else:?>
	message: "구독이 시작 되었습니다."
	<?php endif; ?>

},{
	placement: {
		from: "bottom",
		align: "center"
	},
	allow_dismiss: false,
	offset: 20,
	type: "default",
	timer: 100,
	delay: 1500,
	animate: {
		enter: "animated fadeInUp",
		exit: "animated fadeOutDown"
	}
});

window.parent.$('[data-mbruid="<?php echo $mbruid ?>"]').find('[data-role="num_follower"]').text(<?php echo $num_follower ?>);

</script>
<?php
exit;
?>
