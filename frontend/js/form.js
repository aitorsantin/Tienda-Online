$("document").ready(function()
{
	$("#btnSubmit").click(function()
	{
		ComprobarCaomposVacios();
	});
});

function ComprobarCaomposVacios()
{
	if ($("#txtUsername").val()=="") 
		{
			$("#spUser").text("Campo Obligatorio");
			$("#spUser").css({"color":"red"});
			
		};

	if ($("#txtEmail").val()=="") 
	{
		$("#spEmail").text("Campo Obligatorio");
		$("#spEmail").css({"color":"red"});
	}

	if ($("#txtPass").val()=="") 
	{
		$("#spPass").text("Campo Obligatorio");
		$("#spPass").css({"color":"red"});
	}

	if ($("#txtconfirm").val()=="") 
	{
		$("#spConfirm").text("Campo Obligatorio");
		$("#spConfirm").css({"color":"red"});
	}
};

function CompararPassword()
{
	if ($("#txtPass").text()!=$("#txtconfirm").text()) 
	{

		$("#spConfirm").text("Las contraseñas no coinciden");
		$("#spConfirm").css({"color":"red"});
	}
};