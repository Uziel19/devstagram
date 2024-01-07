import Dropzone from "dropzone";


//Esto se establece porque Por default dropzone va a buscar un elemento que tenga la clase de dropzone pero nosotros queremos darle el comportamiento y decirle a que endpoint y aque ruta queremos enviar las peticiones ( las imagenes)
Dropzone.autoDiscover = false;

// se crea una instancia para colocar dropzone en un selector y se le aplican ciertas configuraciones
const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube aquí tu imagen",
    acceptedFiles: ".png,.jpg,.jpeg, .gif",
    addRemoveLinks: true, // esto va a permitir al usuario eliminar su imagen
    dictRemoveFile: "Borrar Archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function (){ // esta funcion se va a ejecutar automaticamente una vez que se ha creado dropzone (cuando es inicializado)
        // alert("d ropzone creado");

        //la imagen tiene que ser un obj que tenga un size  y un name

        if(document.querySelector('[name="imagen"]').value.trim()){ //si hay una imagen 

            const imagenPublicada = {};
            imagenPublicada.size = 1234; // Aqui el tamaño no importa mucho pero este valor que se requiere
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            //opciones de dropzone
            //call se asigna inmediatamente pero se manda a llamar (automaticamente)
            //bind el resultado es el mismo pero tu tienes que mandar llamar la fn

            this.options.addedfile.call(this,imagenPublicada);
            this.options.thumbnail.call(this,imagenPublicada,`/uploads/${imagenPublicada.name}`);

            
            //colocar las clases de dropzone
            imagenPublicada.previewElement.classList.add('dz-success','dz-complete');



        }
    }

});

//eventos de dropzone    
//Archivo actual - Peticion - formData
// dropzone.on("sending", function (file, xhr, formData) { //cuando se esta enviando  el archivo

//     // console.log(file);//para ver la info del archivo que esta subiendo


//     console.log(formData);

// });
    //Archivo actual - Respuesta

dropzone.on('success', function(file,response){


    console.log(response.imagen); //obtener la respuesta en caso de que se suba correctamente
    document.querySelector('[name="imagen"]').value=response.imagen;// pasamos la img al input oculto

}); //en caso de que se suba correctamente


// dropzone.on('error', function(file,message){ // en caso de que sepas que tu codigo esta bien en el backend pero no se sube


//     console.log(message); // para ver el mensaje de error
// }); 


//cuando se borra el archivo 
dropzone.on('removedfile', function(){ // toma el archivo (imagen y podemos hacer algo con ella)
    document.querySelector('[name="imagen"]').value='';
}); 