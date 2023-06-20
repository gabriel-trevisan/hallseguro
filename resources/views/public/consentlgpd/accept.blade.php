<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.svg') }}" type="image/x-icon" />
    <title>Consentimento | Hall Seguro</title>

</head>

<body style="margin: 0;
    margin-bottom: 50px;">

    {!! $document->body !!}

    <form 
        method="post" 
        action="{{route('publicconsentlgpd.accept', ['documentID' => $document->id, 'customerID' => $customer->id])}}">
        @csrf

        <footer style="
            width: 100%;
            height: 50px;
            background-color: blue;
            position: fixed;
            bottom: 0;
            text-align: center">

            <div class="container-check" style="margin-top: 10px">
                <input 
                    class="form-check-input" 
                    type="checkbox" 
                    value="" 
                    id="checkbox-agree" 
                    onClick="toggle(this)"
                >
                <label class="form-check-label" for="checkbox-agree" style="color: white;">
                    <strong>Eu concordo com a condição acima</strong>
                </label>
                <input type="submit" value="Aceitar" id="button-accept" disabled/>
            </div>
        </footer>
    </form>

</body>

<script>
    function toggle(e){
        buttonAccept = document.getElementById('button-accept');
        if(e.checked){
            buttonAccept.disabled = false;
        } else {
            buttonAccept.disabled = true;
        }
    }
</script>

</html>