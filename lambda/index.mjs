const LARAVEL_API_URL = process.env.LARAVEL_API_URL;
const LARAVEL_API_TOKEN = process.env.LARAVEL_API_TOKEN;

export const handler = async (event) => {
    const { actionGroup, apiPath, httpMethod, parameters = [], requestBody } = event;

    let laravelPath, laravelMethod, laravelBody;

    // Bedrock'tan gelen action → Laravel API mapping
    if (apiPath === '/doctors' && httpMethod === 'GET') {
        laravelPath = '/doctors';
        laravelMethod = 'GET';

    } else if (apiPath.match(/^\/doctors\/\d+\/slots$/) && httpMethod === 'GET') {
        const doctorId = apiPath.split('/')[2];
        const date = getParam(parameters, 'date');
        const week = getParam(parameters, 'week');
        laravelPath = `/doctors/${doctorId}/slots?${date ? 'date=' + date : 'week=' + (week || 'true')}`;
        laravelMethod = 'GET';

    } else if (apiPath === '/appointments' && httpMethod === 'POST') {
        const body = getRequestBody(requestBody);
        laravelPath = '/appointments';
        laravelMethod = 'POST';
        laravelBody = body;

    } else if (apiPath.match(/^\/appointments\/\d+\/cancel$/) && httpMethod === 'POST') {
        const id = apiPath.split('/')[2];
        laravelPath = `/appointments/${id}/cancel`;
        laravelMethod = 'POST';

    } else if (apiPath.match(/^\/appointments\/\d+$/) && httpMethod === 'GET') {
        const id = apiPath.split('/')[2];
        laravelPath = `/appointments/${id}`;
        laravelMethod = 'GET';

    } else {
        return bedrockResponse(actionGroup, apiPath, httpMethod, 400, { error: 'Bilinmeyen endpoint.' });
    }

    const result = await callLaravel(laravelMethod, laravelPath, laravelBody);

    return bedrockResponse(actionGroup, apiPath, httpMethod, result.status, result.data);
};

async function callLaravel(method, path, body = null) {
    const url = `${LARAVEL_API_URL}${path}`;
    const options = {
        method,
        headers: {
            'Authorization': `Bearer ${LARAVEL_API_TOKEN}`,
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        },
    };
    if (body) options.body = JSON.stringify(body);

    const res = await fetch(url, options);
    let data;
    try { data = await res.json(); } catch { data = {}; }
    return { status: res.status, data };
}

function getParam(parameters, name) {
    const p = parameters.find(p => p.name === name);
    return p ? p.value : null;
}

function getRequestBody(requestBody) {
    try {
        return JSON.parse(requestBody?.content?.['application/json']?.body || '{}');
    } catch {
        return {};
    }
}

function bedrockResponse(actionGroup, apiPath, httpMethod, statusCode, body) {
    return {
        messageVersion: '1.0',
        response: {
            actionGroup,
            apiPath,
            httpMethod,
            httpStatusCode: statusCode,
            responseBody: {
                'application/json': { body: JSON.stringify(body) },
            },
        },
    };
}
