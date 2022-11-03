navigator.getUserMedia = navigator.getUserMedia ||
						 navigator.webkitGetUserMedia ||
						 navigator.mozGetUserMedia

function bindEvents(p){

	p.on('error', function(err){
		console.log('error', err)
	})

	p.on('signal', function(data){
		document.querySelector('#offer').textContent = JSON.stringify(data)
	})

	p.on('stream', function(stream){
		const mediaStream = new MediaStream(stream);
		let video = document.querySelector('#receiver-video')
		video.srcObject = mediaStream;
		video.play()
	})

	document.querySelector('#incoming').addEventListener('submit', function(e){
		e.preventDefault()
		p.signal(JSON.parse(e.target.querySelector('textarea').value))
	})
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
		bindEvents(p)
		const mediaStream = new MediaStream(stream);
		let video = document.querySelector('#emitter-video')
		video.srcObject = mediaStream;
		video.play()


	}, function(){})
}


document.querySelector('#start').addEventListener('click', function(e){
	startPeer(true)
})

document.querySelector('#receive').addEventListener('click', function(e){
	startPeer(false)
})
