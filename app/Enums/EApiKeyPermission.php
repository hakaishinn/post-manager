<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EApiKeyPermission extends Enum
{
    const key = 'X-Authorization';

    const showAllPost = 'show-all-post';
    const showAllCategory = 'show-all-category';
    const showAllTag = 'show-all-tag';
    const showAllAuthor = 'show-all-author';
    const showAllAdvertise = 'show-all-advertise';
    const showAllWebsite = 'show-all-website';
    const showAllMenu = 'show-all-menu';
    const showAllPage = 'show-all-page';
    const showAllColor = 'show-all-color';
}
