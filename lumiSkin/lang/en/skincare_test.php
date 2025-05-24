<?php

/**
 * Author:
 * - Manuela Castaño Franco
 */

return [
    'title' => 'Skincare Recommendation Test',
    'form' => 'Fill out the form to get your personalized skincare recommendation',
    'find_best' => 'Find the Perfect Products for You',
    'take_test' => 'Take our skincare test and get personalized recommendations',
    'take_test_now' => 'Take the Test now',
    'routine' => 'Your Skincare Routine',
    'routine_desc' => 'A personalized skincare routine based on your answers',
    'generate_routine' => 'Generate Skincare routine',
    'recommendations' => 'Product Recommendations',
    'based_on_answers' => 'Based on your answers, here are our product recommendations',
    'shop_now' => 'shop Now',
    'back' => 'Back to the Test',
    'no_products' => 'No products found',
    'routine_prompt' => "You are a skincare expert. Below are the user's responses to a skincare test: :responses. Additionally, here are the recommended products based on their preferences: :products. Based on this, generate a detailed skincare routine including steps like cleansing, moisturizing, and sunscreen application.",
    'no_products_store' => 'We currently have no products in the store to recommend. Please check back soon!',
    'chatgpt_error' => 'Error connecting to ChatGPT: ',
    'no_response' => 'Could not generate the response.',

    'makeup_recommendation_prompt' => "You are a makeup expert. Below I provide the user's responses: :responses.
        Additionally, these are the products available in the store (you cannot invent other products): :products.
        Your task is to recommend the most suitable products from the list above, based on their skin type, tone, and preferences.

        **Important instructions**:
        1. You can recommend more than one product.
        2. Mention the PRODUCT NAME and BRAND as they appear in the list.
        3. Use the following format for each recommended product:
        - Product name: [Product name], Brand: [Brand]
        4. At the end, add a brief user-friendly explanation of why these products are ideal for them.

        **Example response**:
        - Product name: Matte Foundation, Brand: Maybelline
        - Product name: Intense Red Lipstick, Brand: MAC

        These products are ideal for you because they control shine and offer a long-lasting finish, perfect for your combination skin and preference for long-wear makeup.",

    'makeup_system_message' => 'You are a professional makeup advisor. You can only recommend products from the store. Inventing products is prohibited.',

    'skincare_system_message' => 'You are a skincare expert. Based on the user responses and the recommended products, generate a skincare routine.',

];
