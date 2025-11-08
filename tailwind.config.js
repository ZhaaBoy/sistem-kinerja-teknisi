/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: "#7C3AED",
                    dark: "#6D28D9",
                },
                secondary: "#E5E7EB",
                danger: {
                    DEFAULT: "#DC2626",
                    dark: "#B91C1C",
                },
                success: {
                    DEFAULT: "#16A34A",
                    dark: "#15803D",
                },
                info: {
                    DEFAULT: "#0EA5E9",
                    dark: "#0369A1",
                },
                warning: {
                    DEFAULT: "#FACC15",
                    dark: "#EAB308",
                },
            },
        },
    },
    plugins: [],
};
