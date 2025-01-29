<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Constants;

class CollectionConst
{
    //region Item statuses
    public const ITEM_PASSWORD_PROTECTED_VISIBILITY = 'passwordProtected';
    public const ITEM_PUBLIC_VISIBILITY = 'public';
    public const ITEM_DEFAULT_VISIBILITY_STATUS = self::ITEM_PUBLIC_VISIBILITY;

    public const ITEM_VISIBILITY_STATUSES = [
        self::ITEM_PUBLIC_VISIBILITY,
        self::ITEM_PASSWORD_PROTECTED_VISIBILITY,
    ];

    public const ITEM_STATUS_DRAFT = 'draft';
    public const ITEM_STATUS_PUBLISHED = 'published';

    public const ITEM_STATUSES = [
        self::ITEM_STATUS_DRAFT,
        self::ITEM_STATUS_PUBLISHED,
    ];

    public const ITEM_DEFAULT_STATUS = self::ITEM_STATUS_DRAFT;

    //endregion

    //region Field types

    public const FIELD_TYPE_TEXT = 'text';
    public const FIELD_TYPE_RICH_TEXT = 'richText';
    public const FIELD_TYPE_PASSWORD = 'password';
    public const FIELD_TYPE_SELECT = 'select';
    public const FIELD_TYPE_CHECK = 'check';
    public const FIELD_TYPE_SWITCH = 'switch';
    public const FIELD_TYPE_FILE = 'file';
    public const FIELD_TYPE_IMAGE = 'image';
    public const FIELD_TYPE_MAP = 'map';
    public const FIELD_TYPE_DATE_TIME = 'dateTime';
    public const FIELD_TYPE_COLOR = 'color';
    public const FIELD_TYPE_NUMBER = 'number';
    public const FIELD_TYPE_EMAIL = 'email';
    public const FIELD_TYPE_LINK = 'link';
    public const FIELD_TYPE_VIDEO_LINK = 'videoLink';
    public const FIELD_TYPE_PHONE = 'phone';
    public const FIELD_TYPE_GALLERY = 'gallery';
    public const FIELD_TYPE_REFERENCE = 'reference';
    public const FIELD_TYPE_MULTI_REFERENCE = 'multiReference';
    public const FIELD_TYPE_RULES = 'rules';

    public const FIELD_TYPES = [
        self::FIELD_TYPE_TEXT,
        self::FIELD_TYPE_RICH_TEXT,
        self::FIELD_TYPE_PASSWORD,
        self::FIELD_TYPE_SELECT,
        self::FIELD_TYPE_CHECK,
        self::FIELD_TYPE_SWITCH,
        self::FIELD_TYPE_FILE,
        self::FIELD_TYPE_IMAGE,
        self::FIELD_TYPE_MAP,
        self::FIELD_TYPE_DATE_TIME,
        self::FIELD_TYPE_COLOR,
        self::FIELD_TYPE_NUMBER,
        self::FIELD_TYPE_EMAIL,
        self::FIELD_TYPE_LINK,
        self::FIELD_TYPE_VIDEO_LINK,
        self::FIELD_TYPE_PHONE,
        self::FIELD_TYPE_GALLERY,
        self::FIELD_TYPE_REFERENCE,
        self::FIELD_TYPE_MULTI_REFERENCE,
        self::FIELD_TYPE_RULES,
    ];

    //endregion

    //region Field placement

    public const FIELD_PLACEMENT_CONTENT = 'content';
    public const FIELD_PLACEMENT_SIDEBAR = 'sidebar';

    public const FIELD_PLACEMENTS = [
        self::FIELD_PLACEMENT_CONTENT,
        self::FIELD_PLACEMENT_SIDEBAR,
    ];

    public const FIELD_DEFAULT_PLACEMENT = self::FIELD_PLACEMENT_CONTENT;

    //endregion

    //region Item order

    public const ITEM_ORDER_BY_WHITELIST = ['id', 'title', 'createdAt', 'updatedAt'];
    public const ITEM_ORDER_BY_DEFAULT = 'createdAt';
    public const ITEM_ORDER_METHOD_DEFAULT = 'desc';

    //endregion

    //region fields configuration

    public const SLUG_DISALLOWED_SYMBOLS_REGEXP = '/([^A-z0-9-])/m';

    //endregion
}
