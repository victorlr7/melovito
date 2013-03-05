<?php
/**
 * @category	Module
 * @package		JomSocial
 * @subpackage	HelloMe
 * @copyright (C) 2008 by Slashes & Dots Sdn Bhd - All rights reserved!
 * @license		GNU/GPL, see LICENSE.php
 */
defined('_JEXEC') or die('Restricted access');
?>
<div class="hello-me">
<?php
if( $my->isOnline() && $my->id != 0 )
{
	$inboxModel			= CFactory::getModel('inbox');
	$notifModel = CFactory::getModel('notification');
	$filter				= array();
	$filter['user_id']	= $my->id;
	$friendModel		= CFactory::getModel ( 'friends' );
	$profileid 			= JRequest::getVar('userid' , 0 , 'GET');
	
	CFactory::load( 'libraries' , 'toolbar' );
	$toolbar = CToolbarLibrary::getInstance();
	$newMessageCount		= $toolbar->getTotalNotifications( 'inbox' );
	$newEventInviteCount	= $toolbar->getTotalNotifications( 'events' );
	$newFriendInviteCount	= $toolbar->getTotalNotifications( 'friends' );
	$newGroupInviteCount	= $toolbar->getTotalNotifications( 'groups' );
	
	$myParams			=&	$my->getParams();
	$newNotificationCount	= $notifModel->getNotificationCount($my->id,'0',$myParams->get('lastnotificationlist',''));
	$newEventInviteCount	= $newEventInviteCount + $newNotificationCount;
	
	
	$params->def('unreadCount',	$inboxModel->countUnRead ( $filter ));
	$params->def('pending', $friendModel->countPending( $my->id ));
	$params->def('myLink', CRoute::_('index.php?option=com_community&view=profile&userid='.$my->id));
	$params->def('myName', $my->getDisplayName());
	$params->def('myAvatar', $my->getAvatar());
	$params->def('myId', $my->id);
	$params->def('myKarma', CUserPoints::getPointsImage($my));
	$params->def('enablephotos', $config->get('enablephotos'));
	$params->def('enablevideos', $config->get('enablevideos'));
	$params->def('enablegroups', $config->get('enablegroups'));
	$params->def('enableevents', $config->get('enableevents'));
	
	$enablekarma	= $config->get('enablekarma') ? $params->get('show_karma' , 1 ) : $config->get('enablekarma');
	$params->def('enablekarma', $enablekarma);

	$js		= modHelloMeHelper::getHelloMeScript( $my->getStatus() , COwnerHelper::isMine($my->id, $profileid) );
	$document	= JFactory::getDocument();
	$document->addScriptDeclaration($js);
	
	if($params->get('enable_facebookconnect', '1'))
	{
		$params->def('facebookuser', modHelloMeHelper::isFacebookUser());
	}
	else
	{
		$params->def('facebookuser', false);
	}
	
	CFactory::load( 'helpers' , 'string');
	
	$unreadCount 	= $params->get('unreadCount', 1);
	$pending 		= $params->get('pending', 1);
	$myLink 		= $params->get('myLink', 1);
	$myName 		= $params->get('myName', 1);
	$myAvatar 		= $params->get('myAvatar', 1);
	$myId 			= $params->get('myId', 1);
	$myKarma 		= $params->get('myKarma', 1);
	$enablephotos 	= $params->get('enablephotos', 1);
	$enablevideos 	= $params->get('enablevideos', 1);
	$enablegroups 	= $params->get('enablegroups', 1);
	$enableevents 	= $params->get('enableevents', 1);
	$show_avatar 	= $params->get('show_avatar', 1);
	$show_karma 	= $params->get('enablekarma', 1);
	$show_myblog 	= $params->get('show_myblog', 1);
	$facebookuser 	= $params->get('facebookuser', false);
	$config	= CFactory::getConfig();
	$uri	= CRoute::_('index.php?option=com_community' , false );
	$uri	= base64_encode($uri);

	CFactory::load('helpers' , 'string' );
?>
<div class="jf-leftbar-pos-absolute">
<style>#jf-hello-me a{font-size:11px;}</style>
<script type="text/javascript" src="<?php echo JURI::root();?>components/com_community/assets/ajaxfileupload.pack.js"></script>
<script type="text/javascript" src="<?php echo JURI::root();?>components/com_community/assets/imgareaselect/scripts/jquery.imgareaselect.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo JURI::root();?>components/com_community/assets/imgareaselect/css/imgareaselect-default.css" />
<div id="jf-hello-me">
	<div style="text-align: center; margin: 4px 0; font-family: 'Cuprum',tahoma,verdana,arial,sans-serif;">
		<div style="margin:-5px 0 5px 0;"><a style="font-size: 14px !important;" href ="<?php echo $myLink; ?>"><?php echo CStringHelper::escape( $myName ); ?></a></div>
		<?php
		if($show_avatar)
		{
		?>
			<div class="profile-avatar" onMouseOver="joms.jQuery('.jf-hellome-rollover').toggle()" onmouseout="joms.jQuery('.jf-hellome-rollover').toggle()">
				<img width="100px" src="<?php echo $myAvatar; ?>" alt="<?php echo CStringHelper::escape( $myName ); ?>" style="border: solid 1px #333;" />
				<div class="jf-hellome-rollover">
					<a href="javascript:void(0)" href="javascript:void(0)" onclick="joms.photos.uploadAvatar('profile','<?php echo $my->id; ?>')">
						<?php echo JText::_('COM_COMMUNITY_CHANGE_AVATAR')?>
					</a>
				</div>
			</div>
		<?php
		}
		?>
		
		<!-- Notification since 2.6 -->
		<div id="jsHelloMenu">
		<ul id="jf-jsNotification">
			<li id="jsGlobal">
				<a href="javascript:joms.notifications.showWindow();" class="" title="<?php echo JText::_( 'COM_COMMUNITY_NOTIFICATIONS_GLOBAL' );?>">
				<?php if( $newEventInviteCount ) { ?>
					<span class="notifcount"><?php echo $newEventInviteCount; ?></span>
				<?php } else { echo "0";} ?>
				</a>
			</li>
			<li id="jsFriend">
				<a href="<?php echo CRoute::_( 'index.php?option=com_community&view=friends&task=pending' );?>" onclick="joms.notifications.showRequest();return false;" class="" title="<?php echo JText::_( 'COM_COMMUNITY_NOTIFICATIONS_INVITE_FRIENDS' );?>">
					<?php if( $newFriendInviteCount ){ ?>
					<span class="notifcount">
						<?php echo $newFriendInviteCount; ?>
					</span>
					<?php } else { echo "0";} ?>
				</a>
			</li>
			<li id="jsInbox">
				<a href="<?php echo CRoute::_( 'index.php?option=com_community&view=inbox' );?>" class=""  onclick="joms.notifications.showInbox();return false;" title="<?php echo JText::_( 'COM_COMMUNITY_NOTIFICATIONS_INBOX' );?>">
					<?php if( $newMessageCount ){ ?>
					<span class="notifcount">
						<?php echo $newMessageCount; ?>
					</span>
					<?php } else { echo "0";} ?>
				</a>
			</li>
		</ul>
		</div>
		<div>
		<?php	
		if($show_karma)
		{
		?>
			<img src="<?php echo $myKarma; ?>" alt="<?php echo JText::_('MOD_HELLOME_KARMA'); ?>" width="103" height="19" />
		<?php
		}
		?>
		</div>
		<div class="helloMeStatusText" style="margin-top:5px;">
			<div id="helloMeEdit" style="display: none;">
				<input name="helloMeStatusText" id="helloMeStatusText" type="text" class="status inputbox" style="width: 90%; margin: 0 auto;" value="" onblur="helloMe.saveStatus();return false;" onkeyup="helloMe.saveChanges(event);return false;" />
			</div>
			<div id="helloMeDisplay">
				<span href="javascript:void(0);" id="helloMeStatusLink" style="text-decoration: none; cursor: pointer;" onclick="helloMe.changeStatus();">
					<span id="helloMeStatus" style="text-decoration: none;color:#fff"></span>
				</span>
			</div>
		</div>
	</div>
	
	<div id="jf-status" style="padding: 5px;background: #333;">
		<a href="javascript:void(0);" id="saveLink" style="line-height: 18px; padding: 0 0 0 22px; display: none; background: transparent url(<?php echo JURI::root(); ?>modules/mod_hellome/images/icons-16x16.gif) no-repeat 0 -440px;" onclick="helloMe.saveStatus();" class="icon-save"><?php echo JText::_('MOD_HELLOME_SAVE_MY_STATUS'); ?></a>
		<a href="javascript:void(0);" id="editLink" style="line-height: 18px; padding: 0 0 0 22px; display: block; background: transparent url(<?php echo JURI::root(); ?>modules/mod_hellome/images/icons-16x16.gif) no-repeat 0 -419px;" onclick="helloMe.changeStatus();" class="icon-edit"><?php echo JText::_('MOD_HELLOME_EDIT_MY_STATUS'); ?></a>
	</div>

	
	<div id="jf-hello-me-menu" style="">
		<div class="jf-friends" style="">
			<a style="line-height: 18px;" href="<?php echo CRoute::_('index.php?option=com_community&view=friends&userid='.$myId); ?>"><?php echo JText::_('Friends'); ?></a>
		</div>
		<?php
		if($enablegroups) 
		{
		?>					
			<div class="jf-groups"style="">
				<a style="line-height: 18px;" href="<?php echo CRoute::_('index.php?option=com_community&view=groups&task=mygroups&userid='.$myId); ?>"><?php echo JText::_('Groups'); ?></a>
			</div>
		<?php
		}
		?>
		<?php
		if($enablephotos) 
		{
		?>
			<div class="jf-photos" style="">
				<a style="line-height: 18px;" href="<?php echo CRoute::_('index.php?option=com_community&view=photos&task=myphotos&userid='.$myId); ?>"><?php echo JText::_('Photos'); ?></a>
			</div>
		<?php
		}
		?>
		<?php
		if($enablevideos) 
		{
		?>
			<div class="jf-videos" style="">
				<a style="line-height: 18px;" href="<?php echo CRoute::_('index.php?option=com_community&view=videos&task=myvideos&userid='.$myId); ?>"><?php echo JText::_('Videos'); ?></a>
			</div>
		<?php
		}
		?>
		<?php
		if($enableevents) 
		{
		?>
			<div class="jf-events" style="">
				<a style="line-height: 18px;" href="<?php echo CRoute::_('index.php?option=com_community&view=events&task=myevents&userid='.$myId); ?>"><?php echo JText::_('Events'); ?></a>
			</div>
		<?php
		}
		?>
		<?php
		if($show_myblog) 
		{
			if(file_exists(JPATH_ROOT . DS . "components" . DS . "com_myblog" . DS . "functions.myblog.php"))
			{
				include_once(JPATH_ROOT . DS . "components" . DS . "com_myblog" . DS . "functions.myblog.php");
				$myblogItemId	= myGetItemId();
		?>
				<div style="background: transparent url(<?php echo JURI::root(); ?>modules/mod_hellome/images/icons-16x16.gif) no-repeat 0 -338px; padding: 0 0 0 22px;">
					<a style="line-height: 18px;" href="<?php echo JRoute::_('index.php?option=com_myblog&blogger='. $myName .'&Itemid='.$myblogItemId); ?>"><?php echo JText::_('MOD_HELLOME_MYBLOGS'); ?></a>
				</div>
		<?php
			}
		}
		?>
	</div>
</div>

	<form action="<?php echo JRoute::_('index.php'); ?>" method="post" name="hellomelogout" id="hellomelogout">	
		<input type="hidden" name="option" value="<?php echo COM_USER_NAME;?>" />
		<input type="hidden" name="task" value="<?php echo COM_USER_TAKS_LOGOUT;?>" />
		<input type="hidden" name="return" value="<?php echo $uri; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
<?php
}
else
{
	$content = '';
	
	if($params->get('enable_login', '1'))
	{
		$uri	= CRoute::_('index.php?option=com_community&view='.$config->get('redirect_login') , false );
		$uri	= base64_encode($uri);
		$html	= '';

		if(JPluginHelper::isEnabled('authentication', 'openid')) 
		{
			JHTML::_('script', 'openid');
		}
?>
		<form action="<?php echo CRoute::_( 'index.php?option='.COM_USER_NAME.'&task='.COM_USER_TAKS_LOGIN ); ?>" method="post" name="form-login" id="jf-form-login" >
			<?php echo $params->get('pretext'); ?>
			<fieldset class="input">
			<p id="form-login-username">
				<label for="username">
					<?php echo JText::_('COM_COMMUNITY_USERNAME') ?><br />
					<input name="username" id="username" type="text" class="inputbox" alt="username" size="18" />
				</label>
			</p>
			<p id="form-login-password">
				<label for="passwd">
					<?php echo JText::_('COM_COMMUNITY_PASSWORD') ?><br />
					<input type="password" name="<?php echo COM_USER_PASSWORD_INPUT;?>" id="passwd" class="inputbox" size="18" alt="password" />
				</label>
			</p>
			<?php 
			if(JPluginHelper::isEnabled('system', 'remember'))
			{
			?>
			<p id="form-login-remember">
				<label for="remember">
					<?php echo JText::_('COM_COMMUNITY_REMEMBER_MY_DETAILS') ?>
					<input type="checkbox" name="remember" id="remember" value="yes" alt="Remember Me" />
				</label>
			</p>
			<?php 
			}
			?>
			<input type="submit" name="Submit" class="button" value="<?php echo JText::_('JF_LOGIN') ?>" />
			</fieldset>
			<div style="margin-left:5px;">
				<div>
					<a href="<?php echo JRoute::_( 'index.php?option='.COM_USER_NAME.'&view=reset' ); ?>">
					<?php echo JText::_('MOD_HELLOME_FORGOT_YOUR_PASSWORD'); ?>
					</a>
				</div>
				<div>
					<a href="<?php echo JRoute::_( 'index.php?option='.COM_USER_NAME.'&view=remind' ); ?>">
					<?php echo JText::_('MOD_HELLOME_FORGOT_YOUR_USERNAME'); ?>
					</a>
				</div>
				<div>
					<a href="<?php echo CRoute::_( 'index.php?option=com_community&view=register&task=activation' ); ?>" class="login-forgot-username">
						<span><?php echo JText::_('MOD_HELLOME_RESEND_ACTIVATION_CODE'); ?></span>
					</a>
				</div>
				<?php
				$usersConfig = &JComponentHelper::getParams( 'com_users' );
				if ($usersConfig->get('allowUserRegistration')) 
				{
				?>
				<div>
					<a href="<?php echo CRoute::_( 'index.php?option=com_community&view=register' ); ?>">
						<?php echo JText::_('MOD_HELLOME_REGISTER'); ?>
					</a>
				</div>
				<?php
				}
				?>
			</div>
			<?php echo $params->get('posttext'); ?>
		
			<input type="hidden" name="option" value="<?php echo COM_USER_NAME;?>" />
			<input type="hidden" name="task" value="<?php echo COM_USER_TAKS_LOGIN;?>" />
			<input type="hidden" name="return" value="<?php echo $uri; ?>" />
			<?php echo JHTML::_( 'form.token' ); ?>
		</form>

<?php
	}
	
	if($params->get('enable_facebookconnect', '1'))
	{
		/** detect and display facebook language **/
		if (!defined('FACEBOOK_LANG_AVAILABLE')) {
		define('FACEBOOK_LANG_AVAILABLE', 1);
		}

		$lang = &JFactory::getLanguage();
		$currentLang =  $lang->get('tag');
		$fbLang =   explode(',', trim(FACEBOOK_LANGUAGE) );
		$currentLang = str_replace('-','_',$currentLang);
		$fbLangCode = '//connect.facebook.net/en_GB/all.js';

		if(in_array($currentLang,$fbLang)==FACEBOOK_LANG_AVAILABLE){
		    $fbLangCode = '//connect.facebook.net/'.$currentLang.'/all.js';
		}

		if( $my->id == 0 )
		{
			if( $config->get('fbconnectkey') && $config->get('fbconnectsecret') )
			{
		?>
			<div id="fb-root"></div>
			
			<script type="text/javascript">
			function cFbInit(){
					// keep looping until user status is not 'notConnected'
					if( typeof window.FB != 'undefined'
						&& window.FB._apiKey != '<?php echo $config->get('fbconnectkey');?>' 
						&& typeof window.jomFbinit == 'function' ){
						jomFbinit();
					}
					else
					{ 
						setTimeout("cFbInit();", 500);  
					}
				}

			cFbInit();
			</script>
			<script type="text/javascript" src="http://connect.facebook.net/en_GB/all.js" ></script>
			<script type="text/javascript">
			function jomFbinit(){
				FB.init({
					appId: '<?php echo $config->get('fbconnectkey');?>', 
					status: true, 
					cookie: true, 
					xfbml: true,
					oauth: true
				});

				/* All the events registered */
				FB.Event.subscribe('auth.login', function(response) {
					joms.connect.update();
					});  
			}

			if( typeof window.FB != 'undefined' ) {
				jomFbinit();
			} else {
				window.fbAsyncInit = jomFbinit;
			}

			</script>
			<fb:login-button autologoutlink="true" scope="read_stream,publish_stream,offline_access,email,user_birthday,status_update,user_status"><?php echo JText::_('COM_COMMUNITY_SIGN_IN_WITH_FACEBOOK');?></fb:login-button>
		<?php
			}
		}
	}
}
?>
</div>