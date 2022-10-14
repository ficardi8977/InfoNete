{{> header}}
<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">Ingresar!</h2>
    <form action="/login/procesarLogin" method="POST">
        <input type="text" name="nombre" placeholder="nombre">
        <input type="text" name="password" placeholder="password" >
        <input type="submit" value="Ingresar">
    </form>
</div>
{{> footer}}
