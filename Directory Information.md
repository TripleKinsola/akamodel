application -- (application directory)
	controllers -- (specific controllers for each view)
		actions -- (general controller actions goes here)
	helpers -- (third party code like mailer or watermarker)
	models -- (data access action files)
		db_abstract -- (database abstraction codes goes here e.g migrations and costum query functions)
	views -- (web pages goes here)
		layouts -- (holds common template files e.g header)
config -- (contains configuration codes in files e.g database configuration in yml format and routing files)
data -- (this will contain data files e.g txt, sql schema, sqlite e.t.c)
doc -- (this is where the appplication documentation is stored)
lib -- (libaries goes here)
log -- (error log files goes here)
public -- (public directory for the web server)
	js
	css
	images
	course_wares
	profile_pictures
tmp -- (temporary files are held here)