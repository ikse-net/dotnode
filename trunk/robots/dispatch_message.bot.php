#!/usr/bin/php
<?
include ('../includes/includes.inc.php');
include ('../includes/config/global.inc.php');

$db =& DB::connect($dsn);
if (DB::isError($db))
                error_log($_SERVER['HTTP_HOST'].' | '.__FILE__.' | Connexion SQL impossible : '.$db->getMessage());

$db->setFetchMode(DB_FETCHMODE_ASSOC);

$messages_r = $db->query('SELECT id, id_mess, id_from, from_str, type, dest, subject, message, date FROM message WHERE box=? ORDER BY id_from', 'outbox');
while($message = $messages_r->fetchRow())
{
	switch($message['dest'])
	{
	case 'one':
		$message_values= array (
			'dest'          => $message['dest'],
			'id'            => $message['id'],
			'subject'       => $message['subject'],
			'message'       => $message['message'],
			'date'          => $message['date'],
			'id_from'       => $message['id_from'],
			'from_str'      => $message['from_str'],
			'type'          => 'message',
			'box'           => 'inbox' );
		$db->autoExecute("message", $message_values, DB_AUTOQUERY_INSERT);

		$message_values['box'] = 'send';
		$message_values['flag'] = 'read';
		$db->autoExecute("message", $message_values, DB_AUTOQUERY_INSERT);

		$db->query('DELETE FROM message WHERE id_mess=?', $message['id_mess']);

		if(get_setting($message['id'], 'messages_sent_directly_to_me') == 'email')
			auto_mail( $message['id_from'],
					$message['id'],
					$message['subject'],
					$message['message']
				 );
		break;

	case 'friends':
		$friends_id = split(',', $db->getOne("SELECT friends_id FROM cache_user WHERE id='".$message['id_from']."'"));
//		$friends_id = $db->query('SELECT relation.id_friend FROM relation LEFT JOIN user ON relation.id_friend=user.id WHERE relation.id=?', $message['id_from']);
		foreach($friends_id as $friend_id)
		{
			$message_values= array (
				'dest'          => $message['dest'],
				'id'            => $friend_id,
				'subject'       => $message['subject'],
				'message'       => $message['message'],
				'date'          => $message['date'],
				'id_from'       => $message['id_from'],
				'from_str'      => $message['from_str'],
				'type'          => 'message',
				'box'           => 'inbox' );

			$db->autoExecute("message", $message_values, DB_AUTOQUERY_INSERT);

			if(get_setting($message['id'], 'messages_sent_to_friends') == 'email')
				auto_mail( $message['id_from'],
						$friend_id,
						$message['subject'],
						$message['message']
					 );

		}

		unset($message_values['id']);
		$message_values['box'] = 'send';
                $message_values['flag'] = 'read';
		$db->autoExecute("message", $message_values, DB_AUTOQUERY_INSERT);

		$db->query('DELETE FROM message WHERE id_mess=?', $message['id_mess']);

		break;

	case 'friends_of_friends':
		$friends_list = $db->getOne("SELECT friends_id FROM cache_user WHERE id='".$message['id_from']."'");
		$foaf_id = split(',', $friends_list);
		$foaf_id[] = $message['id_from'];

		foreach($foaf_id as $key=>$value)
		{
			$foaf_id2[$key] = "'$value'";
		}
		$foaf_id = implode(',',$foaf_id2);

		$foaf_id = $db->getCol('SELECT DISTINCT relation.id_friend FROM relation LEFT JOIN user ON relation.id_friend = user.id WHERE relation.id IN ('.$foaf_id.') AND relation.id_friend <>?',0, $message['id_from']);

		foreach($foaf_id as $friend_id)
                {
                        $message_values= array (
                                'dest'          => $message['dest'],
                                'id'            => $friend_id,
                                'subject'       => $message['subject'],
                                'message'       => $message['message'],
                                'date'          => $message['date'],
                                'id_from'       => $message['id_from'],
				'from_str'      => $message['from_str'],
				'type'          => 'message',
				'box'           => 'inbox' );
			$db->autoExecute("message", $message_values, DB_AUTOQUERY_INSERT);

			if(get_setting($message['id'], 'messages_sent_to_friends_of_friends') == 'email')
				auto_mail( $message['id_from'],
						$friend_id,
						$message['subject'],
						$message['message']
					 );


                }

		unset($message_values['id']);
                $message_values['box'] = 'send';
                $message_values['flag'] = 'read';
                $db->autoExecute("message", $message_values, DB_AUTOQUERY_INSERT);

                $db->query('DELETE FROM message WHERE id_mess=?', $message['id_mess']);

		break;
	}
}

$db->disconnect();
?>
