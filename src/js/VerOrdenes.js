function buscarCliente() {
    var numero = document.getElementById('numero').value;
    var xhr = new XMLHttpRequest();
    console.log(numero);
    xhr.open('GET', '../clientes/BuscarCliente.php?numero=' + numero, true);
    xhr.onload = function() {
        if (xhr.status == 200) {
            var cliente = JSON.parse(xhr.responseText);
            if (cliente) {
                document.getElementById('nombre').value = cliente.nombre;
                document.getElementById('direccion').value = cliente.direccion;
            } else {
                alert('Cliente no encontrado');
            }
        } else {
            alert('Error al buscar cliente');
        }
    };
    xhr.send();
}

function insertarPizza() {
    const pizza = document.getElementById('pizzas');
    const selectOption = document.createElement('select');
    selectOption.name = 'options';
    selectOption.id = 'optionTamanio';

    const defaul = document.createElement('option');
    defaul.value = '0';
    defaul.textContent = 'Seleccione tamaño';
    selectOption.appendChild(defaul);
    console.log(defaul);

    const chicaOption = document.createElement('option');
    chicaOption.value = '1';
    chicaOption.textContent = 'Chica - 99.90';
    selectOption.appendChild(chicaOption);

    const medianaOption = document.createElement('option');
    medianaOption.value = '2';
    medianaOption.textContent = 'Mediana - 139.90';
    selectOption.appendChild(medianaOption);

    const grandeOption = document.createElement('option');
    grandeOption.value = '3';
    grandeOption.textContent = 'Grande - 219.90';
    selectOption.appendChild(grandeOption);

    const areaIngredientes = document.createElement('div');
    areaIngredientes.id = 'areaIngredientes';
    pizza.appendChild(selectOption);
    pizza.appendChild(areaIngredientes);

    // Añadir el event listener después de insertar el select en el DOM
    selectOption.addEventListener('change', () => {
        fetch("../productos/ObtenerIngredientes.php")
            .then(response => response.json())
            .then(data => {
                var eleccion = selectOption.value;
                console.log(eleccion);
                var areaIngredientes = document.getElementById('areaIngredientes');
                areaIngredientes.innerHTML = '';

                

                // Obtener el número de ingredientes según el tamaño seleccionado
                var numIngredientes = 1;
                if (eleccion === '1') {
                    numIngredientes = 1;
                } else if (eleccion === '2') {
                    numIngredientes = 2;
                } else if (eleccion === '3') {
                    numIngredientes = 3;
                }
                // Agregar ingredientes al select según el número obtenido
                for (let i = 0; i < numIngredientes; i++) {
                    const selectIngredientes = document.createElement('select');
                    selectIngredientes.name = 'ingredientes';
                    selectIngredientes.id = 'ingredientes'+`i`;
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.ingrediente_id;
                        option.textContent = item.nombre;
                        selectIngredientes.appendChild(option);
                    });
                    areaIngredientes.append(selectIngredientes);
                }

            });
    });
}

// Asegúrate de llamar a la función insertarPizza() en el momento adecuado
document.addEventListener('DOMContentLoaded', () => {
    insertarPizza();
});
