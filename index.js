var express = require('express');
var app = express();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var bodyParser = require('body-parser');
// Create application/x-www-form-urlencoded parser
var urlencodedParser = bodyParser.urlencoded({ extended: false })
var port = 3000;


app.get('/', function(req, res){
   res.send("Hello world!");
});

app.post('/sendSocketMessage',urlencodedParser, function(req, res){
	//console.log(req.body);
   io.emit('messageTresponse', {to:req.body.to, from:req.body.from, msg:req.body.msg,avatar:req.body.avatar, showVideo:req.body.showVideo,media_type:req.body.media_type});
	res.send('Done');
});

io.sockets.on('connection', function(socket){

	var user_id;
	var user_name;
	var user_avatar;
	var roomName;
	socket.on('loginStatus', function(data){
		user_id = data.currentUser;
		user_name = data.currentUserName;
		user_avatar = data.avatar;
		//console.log('user connected '+user_id);
		io.sockets.emit('userLoginStatus', {userId:data.currentUser, currentUserName:data.currentUserName, avatar:data.avatar});
	});

	socket.on('disconnect', function(){
	    //console.log('user disconnected '+user_id);
	    io.sockets.emit('userLogoutStatus', {userId:user_id, user_name:user_name, user_avatar:user_avatar});
	});

    socket.on('subscribe', function(room) {
    	roomName = room;
        socket.join(room);
    });

	socket.on('chat_message', function(data){
		//console.log(data, 'console new data');
		if(roomName == data.room){
            console.log("I am in the correct path");
			io.sockets.to(data.room).emit('chat message', {msg:data.msg , chatTo:data.chatTo, currentUser:data.currentUser, currentUserName:data.currentUserName, avatar:data.avatar, greatingMsg:data.greatingMsg, msgType:data.msgType, support_name: data.name, teamId:data.teamId, teamName:data.teamName});

			io.sockets.to(data.room).emit('chat message main', {msg:data.msg , chatTo:data.chatTo, currentUser:data.currentUser, currentUserName:data.currentUserName, avatar:data.avatar, greatingMsg:data.greatingMsg, msgType:data.msgType, teamId:data.teamId, teamName:data.teamName});

			io.sockets.to(data.room).emit('receiveMessage', {msg:data.msg , chatTo:data.chatTo, currentUser:data.currentUser, currentUserName:data.currentUserName, avatar:data.avatar, greatingMsg:data.greatingMsg, msgType:data.msgType, teamId:data.teamId, teamName:data.teamName, room:data.room});

            io.sockets.to(data.room).emit('newMessageLineup', {msg:data.msg , chatTo:data.chatTo, currentUser:data.currentUser, currentUserName:data.currentUserName, avatar:data.avatar, greatingMsg:data.greatingMsg, msgType:data.msgType, teamId:data.teamId, teamName:data.teamName, room:data.room});
			//io.sockets.emit('chat message', {msg:data.msg , chatTo:data.chatTo, currentUser:data.currentUser, currentUserName:data.currentUserName, avatar:data.avatar});
			//console.log(data);
		}else{
		    //Notify about a new message or show unread messages count
            console.log("I am in the wrong path");

        }

	});

	socket.on('wait_message', function(data) {
		//console.log(data);
        if(roomName == data.room){
            io.sockets.to(data.room).emit('wait_new_message', {chatTo:data.chatTo, currentUser:data.currentUser, wait:data.wait});
        }
	});

	socket.on('wait_message_widget', function(data) {
		io.sockets.to(data.room).emit('wait_widget_message', {chatTo:data.chatTo, currentUser:data.currentUser, wait:data.wait});
	});

	socket.on('change_support_name', function(data){

		io.sockets.to(data.room).emit('supportname', {room:data.room,supportname:data.supportname});
	});

	socket.on('chat_message_status', function(data){
		io.sockets.emit('chat_message_status_show', {msg:data.msg, chatTo:data.chatTo, currentUser:data.currentUser, currentUserName:data.currentUserName, status:data.status});
	});


    socket.on('team_post_data', function(data){
   	    //console.log(data);
 		io.sockets.to(data.room).emit('team_data_show', {room:data.room, chatTo:data.chatTo, currentUser:data.currentUser,teamName:data.teamName,msg:data.msg});
	});

	socket.on('reassign_post_data', function(data){
   	    //console.log(data);
 		io.sockets.to(data.room).emit('reassign_post_data_show', {user_id:data.user_id,room:data.room, assign_to:data.assign_to, assign_from:data.assign_from,assign_to_name:data.assign_to_name});
	});

	socket.on('forceunassign_post_data', function(data){
   	    //console.log(data);
 		io.sockets.to(data.room).emit('forceunassign_post_data_show', {user_id:data.user_id,room:data.room,preTeamId:data.preTeamId});
	});





	socket.on('unassign_chat_count', function(data) {
		io.sockets.to(data.room).emit('unassign_chat_show', {room:data.room,unAssCount: data.unAssCount, chatTo:data.chatTo, teamName:data.teamName, countUnassign: data.countUnassign});
	});

	socket.on('leaveroom', function(room) {
		//console.log(room);
		socket.leave(room);
	});

	/*-- Support chat --*/
	/*socket.on('chat message', function(msg){
	    io.emit('chat message', msg);
	});*/

	socket.on('support_user', function(data) {
		//console.log(data);
		io.sockets.emit('support_user_created', {support_name: data.name, support_id: data.id, UserID:data.suppUserID,email:data.email, msg:data.msg, currentTime:data.currentTime});
	});

	/*-- End support chat --*/

	/*socket.on("disconnect", function(){
        console.log("client disconnected from server");
    });*/

});

http.listen(port, function(){
  console.log('listening on *:3000');
});
