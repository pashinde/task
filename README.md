Approaching the Test
The test is a demonstration of your OOP skills. There are no right or wrong answers here: the point of the exercise is for you to demonstrat how well you understood the task and your approach in solving it. 


Instruction:
1.	Unzip the file task.zip
2.	Ensure you have atleast  php 7.4 and composer running on your system
3.	In your terminal/cmd navigate to the folder and run ‘composer install‘ to generate the vendor folder
4.	Run php index.php 
5.	Happy coding!
6. Push your completed code to your personal github and share link


TASK:
Attached is a partially complete code in a zip format task.zip 

1.	Inside the code file, you have index.php that has one error that you need to fix 
2.	Inside the src/ folder is a Class file PinGenerator.php. Create a new method called  ‘generate’ and each time the method generate() is called in index file, it should generate and return an array of 5 valid PINs (suitable for use with cash cards, door locks etc.), according to the following rules: 

o	Each PIN should comprises of four numeric digits (e.g. “2845”), 
o	The array generated PINs  should NOT contain repeated PINS 
o	Your  code should NOT generate “obvious” numbers. This should be handled  programmatically to account for the following rules
•	Sequential numbers e.g. 1234 
•	Repeating numbers e.g. 2233 
•	Palindromes numbers e.g 2332 

3. You are free to create additional class or method to handle any specific feature


