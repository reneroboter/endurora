<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$pathToWorkoutData = __DIR__ . '/data/workouts.json';

if (!file_exists($pathToWorkoutData)) {
    throw new RuntimeException('The workouts.json file could not be found!');
}

$workoutData = json_decode(file_get_contents($pathToWorkoutData));

$events = [];

foreach ($workoutData as $workoutDate) {
    $events[] = (new Eluceo\iCal\Domain\Entity\Event())
        ->setSummary($workoutDate->title)
        ->setDescription($workoutDate->description ?? '')
        ->setOccurrence(
            new Eluceo\iCal\Domain\ValueObject\SingleDay(
                new Eluceo\iCal\Domain\ValueObject\Date(
                    \DateTimeImmutable::createFromFormat('Y-m-d\TH:i:s', $workoutDate->workoutDay)
                )
            )
        );
}
$calendar = new Eluceo\iCal\Domain\Entity\Calendar($events);
$componentFactory = new Eluceo\iCal\Presentation\Factory\CalendarFactory();
$calendarComponent = $componentFactory->createCalendar($calendar);

header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="cal.ics"');

echo $calendarComponent;