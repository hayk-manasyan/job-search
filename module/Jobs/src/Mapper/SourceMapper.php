<?php

namespace Jobs\Mapper;


class SourceMapper
{
    /**
     * Source types
     */
    const TYPE_GITHUB = 0;
    const TYPE_STACK_OVERFLOW = 1;
    /**
     * Source titles
     */
    const TITLE_GITHUB = 'Github';
    const TITLE_STACK_OVERFLOW = 'Stack Overflow';

    private static $_sourceMapping = [
        self::TYPE_GITHUB => self::TITLE_GITHUB,
        self::TYPE_STACK_OVERFLOW => self::TITLE_STACK_OVERFLOW,
    ];

    /**
     * Get Source title by type
     * @param int $type
     * @return string           The source title
     * @throws \Exception
     */
    public static function getTitleByType( $type )
    {
        if(isset(static::$_sourceMapping[$type])) {
            return static::$_sourceMapping[$type];
        }

        throw new \Exception('Source is not found for given type');

    }
}