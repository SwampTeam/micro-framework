


# Micro-Framework

Clone the repo, create a file named *config/local-config.php*, copy the code of *config/config.php* and change the SQL login parameter to your local server. 


## Public
* public folder (in root)
* entry point file (in public folder)

## Starting
* bootstrap file
* config (root folder)

## What is missing?

## Logic
* controller
* view

## Data
* model

### DB, one connection 
Singleton is the simplest pattern to be used, no dependency injection. Object Pool (or container) is the best one for the job, but requires dependency injection in each element. Symfony has it build in.
