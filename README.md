# endurora 🏃

Enduroa is a fun project to make TrainingPeaks workout data available as an .ics file. This feature is also available in the official Pro version, but I only need these entries in my personal Google calendar.

# Getting started

## Getting workout data?
1. Log in to your TrainingPeaks account
1. Go to the Network tab on your browser and select Your bearer authorisation token and your athlete ID
   1. You can find both here `https://tpapi.trainingpeaks.com/users/v3/user`
1. Call the API `https https://tpapi.trainingpeaks.com/fitness/v6/athletes/<YOUR_ATHLETE_ID>/workouts/2023-08-21/2024-06-06 > workouts.json`

## Install project?

1. `git clone git@github.com:reneroboter/endurora.git`
1. `cd endurora`
1. `composer install`
1. `mv workout.json to data/workout.json`
1. `php index,php` to verify if everything wokrs

HAVE FUN! 🎉