function envelope_posXY(x, y)
{
	this.x = x;
	this.y = y;
}

function envelope_box(x, y, w, h)
{
	this.x1 = x;
	this.y1 = y;
	this.x2 = x + w;
	this.y2 = y + h;
	
	this.inBox = function(x, y, w, h)
	{
		return (this.x1 <= x + w) && (this.x2 >= x) && (this.y1 <= y + h) && (this.y2 >= y);
	}
}

function envelope_docXY()
{
	var body = document.body;
	var html = document.documentElement;

	var height	= Math.max( body.scrollHeight, body.offsetHeight, 
						   html.clientHeight, html.scrollHeight, html.offsetHeight );

	var width	= Math.max( body.scrollWidth, body.offsetWidth, 
						   html.clientWidth, html.scrollWidth, html.offsetWidth );
						   
	return new envelope_posXY(width, height);
}

function envelope_get_elm_box(elm)
{
	var o = elm;
	
	var x = 0;
	var y = 0;
	
	while (o != null)
	{
		x += o.offsetLeft;
		y += o.offsetTop;
		
		o = o.offsetParent;
	}
	
	return new envelope_box(x, y, elm.offsetWidth, elm.offsetHeight);
}

// ENCODE URI COMPONENT
// --------------------
// If encodeURIComponent is not present, it's set
if (!encodeURIComponent)
	encodeURIComponent = function(s)
	{
		var s = utf8(s);
		var c;
		var enc = "";
		
		for (var i = 0; i < s.length; i++)
		{
			if (ok_URI_chars.indexOf(s.charAt(i)) == -1)
				enc += "%" + toHex(s.charCodeAt(i));
			else
				enc += s.charAt(i);
		}
		
		return enc;
	}

function envelope_rand(min, max)
{
	if (max < min)
		max = min;
		
	return Math.floor((Math.random() * ((max - min) + 1)) + min);
}

function envelope_get_rand_pos()
{
	var img_width = 66;
	var img_height = 73;
	
	// Now... the size of the document
	var sz = envelope_docXY();

	var elms = document.getElementsByTagName('div');
	var nono = [];
	
	for (var i = 0; i < elms.length; ++i)
	{
		if (elms[i].className.match(/\baddiv\b/))
		{
			nono.push(envelope_get_elm_box(elms[i]));
		}
	}
	
	var tries = 0;
	
	while (tries++ < 20)
	{
		var x = envelope_rand(0, sz.x - img_height);
		var y = envelope_rand(0, sz.y - img_width);
		
		var g = false;
		
		for (var i = 0; i < nono.length; ++i)
			if (nono[i].inBox(x, y, img_width, img_height))
			{
				g = true;
				break;
			}
		
		if (!g)
			break;
	}
	
	return new envelope_posXY(x, y);
}


function envelope_show()
{
	var env_pos = envelope_get_rand_pos();
	var d = new Date();
        var n = d.getTime();
	// And now it's time to place it
	var a = document.createElement('a');
	a.innerHTML = '<img src="http://storage.googleapis.com/cdn.womanfreebies.com/assets/images/thanksgiving/pie-m.gif">';
	
	// Let's pick the envelope's position
	a.style.position = 'absolute';
	a.style.left = env_pos.x + 'px';
	a.style.top = env_pos.y + 'px';
	a.style.zIndex = 7000;
	
	a.href = open_en_path + 'open_envelope.php?id=' + envelope_id + '&url=' + encodeURIComponent(window.location.href) + '&title=' + encodeURIComponent(document.title);
	//a.target = '_blank';
	a.onclick = function()
	{
		setTimeout(function()
			{
				document.body.removeChild(a);
			},
			100
		);
	}
	
	document.body.appendChild(a);
}
