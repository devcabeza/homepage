import type { APIRoute } from 'astro';

const SENDRIX_API_KEY = import.meta.env.SENDRIX_API_KEY || '';
const SENDRIX_PROJECT_ID = import.meta.env.SENDRIX_PROJECT_ID || '';
const SENDRIX_URL = import.meta.env.SENDRIX_URL || 'https://sendrix.alejandrocabeza.dev';
const TO_EMAIL = 'alejandrocabezaoficial@gmail.com';

export const POST: APIRoute = async ({ request }) => {
  if (!SENDRIX_API_KEY || !SENDRIX_PROJECT_ID) {
    const missing = [
      !SENDRIX_API_KEY ? 'SENDRIX_API_KEY' : null,
      !SENDRIX_PROJECT_ID ? 'SENDRIX_PROJECT_ID' : null,
    ].filter(Boolean);
    console.error(`Contact API misconfigured — missing env var(s): ${missing.join(', ')}`);
    return new Response(JSON.stringify({ error: 'Server not configured' }), {
      status: 500,
      headers: { 'Content-Type': 'application/json' },
    });
  }

  try {
    const body = await request.json();
    const { name, email, message } = body;

    if (!name || !email || !message) {
      return new Response(
        JSON.stringify({ error: 'Missing required fields: name, email, message' }),
        { status: 400, headers: { 'Content-Type': 'application/json' } }
      );
    }

    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      return new Response(
        JSON.stringify({ error: 'Invalid email address' }),
        { status: 400, headers: { 'Content-Type': 'application/json' } }
      );
    }

    const html = `
      <h2>Nuevo mensaje de contacto</h2>
      <p><strong>Nombre:</strong> ${name}</p>
      <p><strong>Email:</strong> ${email}</p>
      <p><strong>Mensaje:</strong></p>
      <p>${message}</p>
    `;

    const sendrixResponse = await fetch(`${SENDRIX_URL}/api/v1/send`, {
      method: 'POST',
      headers: {
        'Authorization': `Bearer ${SENDRIX_API_KEY}`,
        'X-Project-ID': SENDRIX_PROJECT_ID,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        to: TO_EMAIL,
        subject: `Nuevo mensaje de contacto de ${name}`,
        html,
        reply_to: email,
      }),
    });

    const sendrixData = await sendrixResponse.json();

    if (!sendrixResponse.ok) {
      console.error('Sendrix error:', sendrixData);
      return new Response(
        JSON.stringify({ error: 'Failed to send message' }),
        { status: 502, headers: { 'Content-Type': 'application/json' } }
      );
    }

    return new Response(
      JSON.stringify({ success: true, message: 'Mensaje enviado correctamente' }),
      { status: 200, headers: { 'Content-Type': 'application/json' } }
    );
  } catch (err) {
    console.error('Contact API error:', err);
    return new Response(
      JSON.stringify({ error: 'Internal server error' }),
      { status: 500, headers: { 'Content-Type': 'application/json' } }
    );
  }
};
