<?php

class App {

	const MAJOR = 1;
    const MINOR = 2;
    const PATCH = 3;

    public static function version()
    {
        $commitHash = trim(shell_exec('git log --pretty="%h" -n1 HEAD'));

        $commitDate = new \DateTime(trim(shell_exec('git log -n1 --pretty=%ci HEAD')));
        $commitDate->setTimezone(new \DateTimeZone('UTC'));

        return sprintf('v%s.%s.%s.%s %s', self::MAJOR, self::MINOR, self::PATCH, $commitHash, $commitDate->format('Y'));
    }

}