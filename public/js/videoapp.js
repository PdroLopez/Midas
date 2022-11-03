navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

function bindEvents(p){

	p.on('error', function(err){
		console.log('error', err);
	});

	p.on('signal', function(data){
		let oferta = JSON.stringify(data);
		GuardarStream(oferta);
		document.querySelector('#mi_oferta').textContent = oferta;
	});

	p.on('stream', function(stream){
		const mediaStream = new MediaStream(stream);
		let video = document.querySelector('#receiver-video');
		video.volume = 0;
		video.srcObject = mediaStream;
		video.play();
	});

	$("#registrar_oferta").click(function() {
		p.signal(JSON.parse(document.getElementById('oferta_recibida').value));
	});

	$("#registrar_respuesta").click(function() {
		p.signal(JSON.parse(document.getElementById('respuesta_recibida').value));
	});

}

function startPeer(initiator){
	navigator.getUserMedia({
		video: true,
		audio: true
	}, function(stream){
		let p = new SimplePeer({
			initiator: initiator,
			stream: stream,
			trickle: false,
			config: {
			 iceServers: [
				{
				 urls: "stun:numb.viagenie.ca",
				 username: "sultan1640@gmail.com",
				 credential: "98376683"
				},
				{
				 urls: "turn:numb.viagenie.ca",
				 username: "sultan1640@gmail.com",
				 credential: "98376683"
				}
			 ]
	 		}
		})
		bindEvents(p);
		const mediaStream = new MediaStream(stream);
		let emitterVideo = document.querySelector('#emitter-video');
		emitterVideo.volume = 0;
		emitterVideo.srcObject = mediaStream;
		emitterVideo.play();
	}, function(){});
}

// document.querySelector('#start').addEventListener('click', function(e){
// 	startPeer(true);
// })
//
// document.querySelector('#receive').addEventListener('click', function(e){
// 	startPeer(false);
// })
