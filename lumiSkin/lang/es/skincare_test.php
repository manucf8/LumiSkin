<?php

/**
 * Author:
 * - Manuela Castaño Franco 
 */

return [
    'title' => 'Test de Recomendación de Cuidado Facial',
    'form' => 'Completa el formulario para obtener tu recomendación personalizada de cuidado facial',
    'find_best' => 'Encuentra los Productos Perfectos para Ti',
    'take_test' => 'Realiza nuestro test de cuidado facial y obtén recomendaciones personalizadas',
    'take_test_now' => 'Realizar el Test ahora',
    'routine' => 'Tu Rutina de Cuidado Facial',
    'routine_desc' => 'Una rutina de cuidado facial personalizada basada en tus respuestas',
    'generate_routine' => 'Generar Rutina de Cuidado Facial',
    'recommendations' => 'Recomendaciones de Productos',
    'based_on_answers' => 'Basado en tus respuestas, aquí están nuestras recomendaciones de productos',
    'back' => 'Volver al Test',
    'no_products' => 'No se encontraron productos',
    'routine_prompt' => "Eres un experto en cuidado facial. A continuación están las respuestas del usuario a un test de cuidado facial: :responses. Además, aquí están los productos recomendados según sus preferencias: :products. Basado en esto, genera una rutina detallada de cuidado facial incluyendo pasos como limpieza, hidratación y aplicación de protector solar.",
    'no_products_store' => 'Actualmente no tenemos productos en la tienda para recomendar. ¡Por favor, vuelve pronto!',
    'chatgpt_error' => 'Error al conectar con ChatGPT: ',
    'no_response' => 'No se pudo generar la respuesta.',

    'makeup_recommendation_prompt' => "Eres un experto en maquillaje. A continuación proporciono las respuestas del usuario: :responses. 
        Además, estos son los productos disponibles en la tienda (no puedes inventar otros productos): :products. 
        Tu tarea es recomendar los productos más adecuados de la lista anterior, basándote en su tipo de piel, tono y preferencias.

        **Instrucciones importantes**:
        1. Puedes recomendar más de un producto.
        2. Menciona el NOMBRE DEL PRODUCTO y la MARCA tal como aparecen en la lista.
        3. Usa el siguiente formato para cada producto recomendado:
        - Nombre del producto: [Nombre del producto], Marca: [Marca]
        4. Al final, añade una breve explicación amigable de por qué estos productos son ideales para ellos.

        **Ejemplo de respuesta**:
        - Nombre del producto: Base Mate, Marca: Maybelline
        - Nombre del producto: Lápiz Labial Rojo Intenso, Marca: MAC

        Estos productos son ideales para ti porque controlan el brillo y ofrecen un acabado duradero, perfecto para tu piel mixta y preferencia por maquillaje de larga duración.",

    'makeup_system_message' => 'Eres un asesor profesional de maquillaje. Solo puedes recomendar productos de la tienda. Está prohibido inventar productos.',

    'skincare_system_message' => 'Eres un experto en cuidado facial. Basado en las respuestas del usuario y los productos recomendados, genera una rutina de cuidado facial.',

];
