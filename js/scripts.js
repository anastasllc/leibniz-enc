$(document).ready(function() {
    $('#encrypt').click(function() {
	encrypt($('#alphabets').val(), $('#gear').val(), $('#dec-message').val());
    });

    $('#decrypt').click(function() {
	decrypt($('#alphabets').val(), $('#gear').val(), $('#enc-message').val());
    });

    $('#save').click(function() {
	save($('#alphabets').val(), $('#gear').val());
    });

    function encrypt(alphabets, gear, message)
    {
	$.post(
	    'controller.php',
	    {
		alphabets: alphabets,
		gear: gear,
		message: message,
		action: 'encrypt'
	    },
	    function(response)
	    {
		$('#enc-message').val(response);
	    }
	);
    }

    function decrypt(alphabets, gear, message)
    {
	$.post(
	    'controller.php',
	    {
		alphabets: alphabets,
		gear: gear,
		message: message,
		action: 'decrypt'
	    },
	    function(response)
	    {
		$('#dec-message').val(response);
	    }
	);
    }

    function save(alphabets, gear)
    {
	$.post(
	    'controller.php',
	    {
		alphabets: alphabets,
		gear: gear,
		action: 'save'
	    },
	    function(response)
	    {

	    }
	);
    }
    
});