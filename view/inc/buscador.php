<form class="main-form" onsubmit=enviar()>
    <div>

        <label for="main-search"></label>
        
        <input class="input-text input-text--border-radius input-text--style-2" type="text" 
        id="main-search" name="buscador" placeholder="Buscar un producto" onkeyup="buscarProducto()">
        
        <button class="btn btn--icon fas fa-search main-search-button"  id="buscadord"></button>
        
    </div>
    
</form>

<script>
    document.getElementById("buscadord").addEventListener("click", function(event){
        event.preventDefault()
        buscarProducto()
    });
</script>
<style>
</style>