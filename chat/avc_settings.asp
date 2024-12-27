<%

''############### AVChat 1.3 Configuration file ####################

''######################## MANDATORY FIELDS #########################
''$connectionstring:String
''description: Flash Communication Server connection string. You should get this from your FCS account provider.
''If the FCS is installed on the same machine from wheere the avchat.swf file is served you can leave the default connection string
''values: 'rtmp:/avchat/', 'rtmp://myRTMPServer.myDomain.com/app', etc...
''$connectionstring='rtmp://devel.wwwebmasters.com/sample/asd2';
Dim connectionstring
connectionstring="rtmp://localhost/avchat13red/"


''######################### OPTIONAL FIELDS (GENERAL) ###############
''//$langagefilter:String
''//description:activates or deactivates bad language filter
''//values: 'lobby' (only for lobby), 'full' (for all rooms), 'off' (no language filter)
''//default: 'lobby'
Dim languagefilter
languagefilter="lobby"


''//$createroom:Number
''//description: if set to 0 the 'CREATE ROOM' button will be hidden.
''//values: 1, 0
''//default:1
Dim createroom
createroom="true"

''//$autostartcamera:Number
''//description: if set to 1, when a user has a webcamera, immediatley after connecting his camera will start broadcasting, if set to 0, the user will have to press the "Start my camera" button to start it
''//values 0,1 
''//default :0
Dim autostartcamera
autostartcamera="false"

''//$showgradient:Number
''//description: if set to 1 the background color of the chat will get a small gradient from a darker color to a lighter color. This is most visible in the login screen.
''//values: 0 , 1
''//default:1
Dim showgradient
showgradient="true"

''//$usnmaxchars
''//description: the minimum numbers of characters a username must have, if you provide 0 or a negative value it will default to 1
''//values: 3,4,5.. any number
''//defalt: 3
Dim usnminchars
usnminchars=3

''//$username:String
''//description: the default username to be used in the Login NICK log in box in the flash user interface
''//values:only words with characters in this range: 0..9,a..z,A..Z,@,.
''//default:''
Dim username
username=""

''//$changeuser:Boolean
''//description: allows or denies a user to edit his nickname in the NICK log in box in the flash user interface
''//values: 0, 1
''//default: 1
Dim changeuser
changeuser="true"

''//$genre:String
''//description: the default genre to be used in the Genre radio buttons in the flash user interface
''//values: 'male', 'female'
''//default: 'male'
Dim genre
genre="male"

''//$changegenre:Boolean
''//description: allows or denies a user to modify his genre in the NICK log in box in the flash user interface
''//values: 0,1
''//default: 1
Dim changegenre
changegenre="true"

''//$userlevel:String
''//description: if you set this value to free for a user, you will be able to use the 2 limits described below for that user
''//values: 'free','premium'
''//default: premium
Dim userlevel
userlevel="free"


''//$freefps:Number
''//description:using this variable you can limit the ammount of videoframes/second a user recieves from the FMS/FCS server, independent of the fps of the original video stream sent to the server by the users that are broadcasting their webcams/ set it to 0 to disable
''//values: 1, 2, 3, 4, 5, 0.1, 0.5, etc..
''//default: 0 disabled)
Dim freefps
freefps=0


''//$freevideotime:Number
''//description: the ammounts of time (in seconds) that a "free" user can view other videos in 1 day. Each "day" starts at midnight(00:00:00) and ends at 23:59:59 the same day, based on the clock of the users computer.
''//values: 120,600,etc..
''//default: 0 (disabled)
Dim freevideotime
freevideotime=6000


''##################### DO NOT EDIT BELOW ############################
Response.write("&createroom=")
Response.write(createroom)
Response.write("&autostartcamera=")
Response.write(autostartcamera)
Response.write("&showgradient=") 
Response.write(showgradient)
Response.write("&usnminchars=") 
Response.write(usnminchars)
Response.write("&userlevel=") 
Response.write(userlevel)
Response.write("&changegenre=")
Response.write(changegenre)
Response.write("&changeuser=")
Response.write(changeuser)
Response.write("&username=")
Response.write(username)
Response.write("&genre=")
Response.write(genre)
Response.write("&freefps=")
Response.write(freefps)
Response.write("&freevideotime=")
Response.write(freevideotime)
Response.write("&connectionstring=")
Response.write(connectionstring)
Response.write("&debug=0&languagefilter=")
Response.write(languagefilter)

%>