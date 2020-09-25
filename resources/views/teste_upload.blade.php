<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">

<link rel="stylesheet" href="{{URL::asset('plugins/jquery_form/style.css')}}"/>
<script src="{{URL::asset('plugins/jquery_v3.3.1/jquery-3.3.1.min.js')}}"></script>
<script src="{{URL::asset('plugins/jquery_form/jquery.form.min.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function()
    {
        $('#submitButton').click(function()
        {

            $('#uploadForm').ajaxForm(
            {
                target: '#outputImage',
                url: 'ajax-arquivo',
                beforeSubmit: function()
                {
                    console.log('before');

                    $("#outputImage").hide();

                    if($("#uploadImage").val() == "")
                    {
                        $("#outputImage").show();
                        $("#outputImage").html("<div class='error'>Choose a file to upload.</div>");

                        return false;
                    }

                    $("#progressDivId").css("display", "block");
                    var percentValue = '0%';

                    $('#progressBar').width(percentValue);
                    $('#percent').html(percentValue);
                },
                uploadProgress: function (event, position, total, percentComplete)
                {
                    var percentValue = percentComplete + '%';
                    $("#progressBar").animate(
                    {
                        width: '' + percentValue + ''
                    },
                    {
                        duration: 5000,
                        easing: "linear",
                        step: function (x)
                        {
                            percentText = Math.round(x * 100 / percentComplete);
                            $("#percent").text(percentText + "%");

                            if(percentText == "100")
                            {
                                $("#outputImage").show();
                            }
                        }
                    });
                },
                error: function (response, status, e)
                {
                    console.log(response);
                },
                complete: function (xhr)
                {
                    if (xhr.responseText && xhr.responseText != "error")
                    {
                        $("#outputImage").html(xhr.responseText);
                    }
                    else
                    {
                        $("#outputImage").show();
                        $("#outputImage").html("<div class='error'>Problem in uploading file.</div>");
                        $("#progressBar").stop();
                    }
                }
            });
        });
    });
</script>

</head>
<body>
    <h1>jQuery Ajax Image Upload with Animating Progress Bar</h1>
    <div class="form-container">
        <form action="ajax-arquivo" id="uploadForm" name="frmupload" method="post" enctype="multipart/form-data">
            @csrf

            <input type="file" id="uploadImage" name="arquivo" />

            <input id="submitButton" type="submit" name='btnSubmit' value="Submit Image" />

        </form>
        <div class='progress' id="progressDivId">
            <div class='progress-bar' id='progressBar'></div>
            <div class='percent' id='percent'>0%</div>
        </div>
        <div style="height: 10px;"></div>
        <div id='outputImage'></div>
    </div>
</body>
</html>
