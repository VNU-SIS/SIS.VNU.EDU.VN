<?php

declare(strict_types=1);

namespace App\Enums;

/**
 * DBConstant enum.
 */
class DBConstant
{
    // user role
    const TEACHER = 1;
    const SUPPER_ADMIN = 2;
    const TEACHER_POST = 3;

    // categories
    const INTRODUCTION = 1;
    const ADMISSIONS = 2;
    const EDUCATION = 3;
    const NEWS = 4;
    const COOPERATION = 5;
    const SCIENTIFIC_RESEARCH = 6;
    const SIS_ALUMNI = 7;
    const SIS_STUDENT = 8;
    const EVENT = 68;

    // image
    const SYSTEM_GALLERY_ID = 0;
    const SLIDER_TYPE = 1;
    const BANNER_TOP_TYPE = 2;
    const BANNER_BOT_TYPE = 3;
    const BANNER_TEXT_TYPE = 4;
}