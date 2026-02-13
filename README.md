# Olympus Archives
A PHP + MySQL Greek mythology site built for my Web Development course.

## Features
- Character database (gods, titans, heroes, monsters) with individual profile pages
- Myths listing (with categories like Creation, Quests, Tragedies)
- Games:
  - "Which God Are You?" quiz (Dynamic JavaScript)
  - Mythology Trivia quiz
- User accounts with profile + favorite character/myth
- SVG logo and responsive layout

## Tech Stack
- PHP (with includes for nav/footer, profile, etc.)
- MySQL via XAMPP (MariaDB)  
- HTML5, CSS3, JavaScript  
- Dynamic JS for quizzes
- SVG for site logo

## Setup
1. Copy this folder into `xampp/htdocs/olympus`.
2. Create a database `olympus_db`.
3. Run `sql/seed_characters.php` in your browser to populate characters.
4. Visit `http://localhost/olympus/html/index.php`.
