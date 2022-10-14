{{> header}}
<div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
    {{#usuario}}
        <h2 class="w3-wide">Bienvenido {{Nombre}}</h2>
        <p> {{Email}} - {{IdTipoUsuario}}</p>
    {{/usuario}}
    {{^usuario}}
        el usuario ingreso no existe
    {{/usuario}}
</div>
{{> footer}}