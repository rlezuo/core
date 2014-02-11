<?php
/**
 * Copyright (c) 2013, Bjoern Schiessle <schiessle@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING-README file.
 *
 * @brief check migration status
 */
use OCA\Encryption\Util;

\OCP\JSON::checkAppEnabled('files_encryption');

$loginname = isset($_POST['user']) ? $_POST['user'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

if ($loginname !== '' && $password !== '') {
	$username = \OCP\User::checkPassword($loginname, $password);
	if ($username) {
		$util = new Util(new \OC_FilesystemView('/'), $username);
		$migrationStatus = $util->getMigrationStatus();
	}
}

\OCP\JSON::success(array('data' => array('migrationStatus' => $migrationStatus)));
