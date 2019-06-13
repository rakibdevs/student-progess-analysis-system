<?php
session_start();
echo filectime(session_save_path().'/sess_'.session_id());
?>