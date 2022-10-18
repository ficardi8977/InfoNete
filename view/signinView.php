{{> header}}
<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    <h2 class="w3-wide">Registrarse!</h2>
    <form action="signin/procesarSignin" method="POST">
        <input type="text" name="nombre" placeholder="nombre">
        <input type="password" name="password" placeholder="password" >
        <input type="submit" value="Ingresar">
    </form>
</div>
{{> footer}}