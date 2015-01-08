The framework 


How to make it work:
	Open: ./config/config.inc.php => make respective configurations

	Newly introduced classes should be placed @ ./application/helpers/ OR ./application/models/ with the file extention *.help.php OR *.class.php respectively

	./application/controllers/ => contains every public or "views" page controller (They are kept here for as a reason of code separations)

	Open: ./config/initialize.inc.php => require there, the newly introduced class. Worry not about the db_abstract migrations; for they auto load at each of their instances.


Major/Basic dirs: 
	application => API

	test => functionality testing ground. [The file @ ./config/initialize.inc.php is required at the head of any test file, if needed, to have the framework gems ready to be use]

	public => for http public access. [The file @ ./config/initialize.inc.php is required at the head of any public file, if needed, to have the framework gems ready to be use]