module.exports = {
    'env': {
        'browser': true,
        'es2021': true
    },
    'extends': [
        'eslint:recommended',
        'plugin:es-beautifier/standard'
    ],
    'parserOptions': {
        'ecmaVersion': 12,
        'sourceType': 'script'
    },
    'plugins': [
        'es-beautifier'
    ],
    'rules': {
        'indent': ['error', 4],
        'linebreak-style': ['error', 'unix'],
        'no-console': 'warn',
        'quotes': ['error', 'single'],
        'semi': ['error', 'always'],
    },
    'globals': {
      '$': 'readonly',
      'KB': 'readonly',
    }
};
