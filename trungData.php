<?php
//reasons for reason-box
$reasons = [
    [
        'image' => './styles/images/shakehand.jpg',
        'title' => 'Extensive network',
        'pictureName' => 'partnered',
        'description' => 'Partnered with over 2000 tech companies worldwide'
    ],
    [
        'image' => './styles/images/specialized.jpg',
        'title' => 'Professional Team',
        'pictureName' => 'specialized',
        'description' => 'Specialized in IT recruitment (Frontend, Backend, UI/UX, QA, etc.)'
    ],
    [
        'image' => './styles/images/support.jpg',
        'title' => 'Conscientious',
        'pictureName' => 'support',
        'description' => 'Supports on-site, remote, or hybrid work'
    ],
    [
        'image' => './styles/images/coaching.jpg',
        'title' => 'Methodical Training',
        'pictureName' => 'coaching',
        'description' => 'Free career coaching and skill development services'
    ]
];



//Jobs + ENUM
enum Company: string
{
    case AMAZON = 'Amazon';
    case GOOGLE = 'Google';
    case DRIBBBLE = 'Dribbble';
    case TWITTER = 'Twitter';
    case AIRBNB = 'Airbnb';
    case APPLE = 'Apple';
}

enum JobTitle: string
{
    case SENIOR_UI_UX = 'Senior UI/UX Designer';
    case JUNIOR_UI_UX = 'Junior UI/UX Designer';
    case SENIOR_MOTION = 'Senior Motion Designer';
    case UX_DESIGNER = 'UX Designer';
    case GRAPHIC_DESIGNER = 'Graphic Designer';
}

enum JobTag: string
{
    case PART_TIME = 'Part time';
    case FULL_TIME = 'Full time';
    case SENIOR_LEVEL = 'Senior level';
    case JUNIOR_LEVEL = 'Junior level';
    case MIDDLE_LEVEL = 'Middle level';
    case DISTANT = 'Distant';
    case PROJECT_WORK = 'Project work';
    case FULL_DAY = 'Full Day';
    case SHIFT_WORK = 'Shift work';
    case FLEXIBLE_SCHEDULE = 'Flexible Schedule';
}

enum Location: string
{
    case SAN_FRANCISCO = 'San Francisco, CA';
    case CALIFORNIA = 'California, CA';
    case NEW_YORK = 'New York, NY';
}

enum Per: string
{
    case HOUR = 'hr';
    case DAY = 'Day';
    case WEEK = 'Week';
    case Month = 'Month';
}

$jobs = [
    [
        'jobNumber' => 'fourth',
        'date' => '20 May, 2023',
        'company' => Company::AMAZON,
        'title' => JobTitle::SENIOR_UI_UX,
        'tags' => [JobTag::PART_TIME, JobTag::SENIOR_LEVEL, JobTag::DISTANT, JobTag::PROJECT_WORK],
        'salary' => '250',
        "per" => PER::HOUR,
        "job_reference_number" => "9C9VA",
        'location' => Location::SAN_FRANCISCO
    ],
    [
        'jobNumber' => 'second',
        'date' => '4 Feb, 2023',
        'company' => Company::GOOGLE,
        'title' => JobTitle::JUNIOR_UI_UX,
        'images' => './styles/images/figma.png',
        'tags' => [JobTag::FULL_TIME, JobTag::JUNIOR_LEVEL, JobTag::DISTANT, JobTag::PROJECT_WORK, JobTag::FLEXIBLE_SCHEDULE],
        'salary' => '150',
        "per" => PER::HOUR,
        "job_reference_number" => "UV991",
        'location' => Location::CALIFORNIA
    ],
    [
        'jobNumber' => 'first',
        'date' => '29 Jan, 2023',
        'company' => Company::DRIBBBLE,
        'title' => JobTitle::SENIOR_MOTION,
        'images' => './styles/images/dribble.png',
        'tags' => [JobTag::PART_TIME, JobTag::SENIOR_LEVEL, JobTag::FULL_DAY, JobTag::SHIFT_WORK],
        'salary' => '260',
        "per" => PER::HOUR,
        "job_reference_number" => "2Q7X9",
        'location' => Location::NEW_YORK
    ],
    [
        'jobNumber' => 'third',
        'date' => '11 Apr, 2023',
        'company' => Company::TWITTER,
        'title' => JobTitle::UX_DESIGNER,
        'tags' => [JobTag::FULL_TIME, JobTag::MIDDLE_LEVEL, JobTag::DISTANT, JobTag::PROJECT_WORK],
        'salary' => '120',
        "per" => PER::HOUR,
        "job_reference_number" => "BUY4Z",
        'location' => Location::CALIFORNIA
    ],
    [
        'jobNumber' => 'last',
        'date' => '2 Apr, 2023',
        'company' => Company::AIRBNB,
        'title' => JobTitle::GRAPHIC_DESIGNER,
        'tags' => [JobTag::PART_TIME, JobTag::SENIOR_LEVEL],
        'salary' => '300',
        "per" => PER::HOUR,
        "job_reference_number" => "K98YX",
        'location' => Location::NEW_YORK
    ],
    [
        'jobNumber' => 'fifth',
        'date' => '18 Jan, 2023',
        'company' => Company::APPLE,
        'title' => JobTitle::GRAPHIC_DESIGNER,
        'tags' => [JobTag::PART_TIME, JobTag::DISTANT],
        'salary' => '140',
        "per" => PER::HOUR,
        "job_reference_number" => "RAH1X",
        'location' => Location::SAN_FRANCISCO
    ]
];
