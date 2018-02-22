<?php

namespace pxgamer\WwrgTorrents\Config;

class App
{
    // App Configuration
    const APP_NAME = 'WWRG Torrents Backup';

    // Environment Configuration
    const ENV_PRODUCTION = 'production';
    const ENV_DEVELOPMENT = 'development';
    const ENV_MODE = self::ENV_DEVELOPMENT;

    // Logging Configuration
    const LOG_DIRECTORY = ROOT_PATH . 'logs';
    const LOG_ERROR = 'errors.log';

    // Torrents Configuration
    const DEFAULT_TRACKERS = [
        'udp://9.rarbg.com:2710/announce',
        'udp://tracker.publicbt.com/announce',
        'udp://open.demonii.com/1337'
    ];
    const CRON_USER = 'https://worldwidetorrents.eu/api/group/torrents/?id=3';
}
