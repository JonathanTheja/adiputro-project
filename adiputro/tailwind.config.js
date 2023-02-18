/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                "custom-blue": "rgb(15,77,134)",
                "custom-light-blue": "rgb(218,242,255)",
                "custom-light-blue2": "rgb(237,248,255)",
            },
            zIndex: {
                0: "0",
                1: "1",
                2: "2",
                3: "3",
                4: "4",
                5: "5",
            },
            height: {
                "-300px": "-300px",
                "-250px": "-250px",
                "100px": "100px",
                "200px": "200px",
                "250px": "250px",
                "280px": "280px",
                "300px": "300px",
                "330px": "330px",
                "400px": "400px",
                "450px": "450px",
                "430px": "430px",
                "500px": "500px",
                "600px": "600px",
                "700px": "700px",
                "800px": "800px",
                "900px": "900px",
                "10vh": "10vh",
                "20vh": "20vh",
                "30vh": "30vh",
                "40vh": "40vh",
                "50vh": "50vh",
                "60vh": "60vh",
                "65vh": "65vh",
                "80vh": "80vh",
                "75vh": "75vh",
                "77vh": "77vh",
                "70vh": "70vh",
                "80vh": "80vh",
                "90vh": "90vh",
            },
            width: {
                "80px": "80px",
                "85px": "85px",
                "90px": "90px",
                "100px": "100px",
                "130px": "130px",
                "150px": "150px",
                "160px": "160px",
                "200px": "200px",
                "250px": "250px",
                "280px": "280px",
                "300px": "300px",
                "350px": "350px",
                "380px": "380px",
                "400px": "400px",
                "500px": "500px",
                "600px": "600px",
                "700px": "700px",
                "800px": "800px",
                "900px": "900px",
                "10vh": "10vh",
                "20vh": "20vh",
                "30vh": "30vh",
                "40vh": "40vh",
                "50vh": "50vh",
                "60vh": "60vh",
                "65vh": "65vh",
                "80vh": "80vh",
                "75vh": "75vh",
                "77vh": "77vh",
                "70vh": "70vh",
                "80vh": "80vh",
                "90vh": "90vh",
            },
            inset: {
                70: "17.4rem",
                "160px": "160px",
            },
            minHeight: {
                "100px": "100px",
                "200px": "200px",
                "250px": "250px",
                "280px": "280px",
                "300px": "300px",
                "400px": "400px",
                "500px": "500px",
                "600px": "600px",
                "700px": "700px",
                "800px": "800px",
                "900px": "900px",
                "10vh": "10vh",
                "20vh": "20vh",
                "30vh": "30vh",
                "40vh": "40vh",
                "50vh": "50vh",
                "60vh": "60vh",
                "65vh": "65vh",
                "80vh": "80vh",
                "75vh": "75vh",
                "77vh": "77vh",
                "70vh": "70vh",
                "80vh": "80vh",
                "90vh": "90vh",
            },
        },
        fontSize: {
            '15px': '15px',
            'xs': ['0.75rem', {
                lineHeight: '1rem',
            }],
            'sm': ['0.875rem', {
                lineHeight: '1.25rem',
            }],
            'base': ['1rem', {
                lineHeight: '1.5rem',
            }],
            'lg': ['1.125rem', {
                lineHeight: '1.75rem',
            }],
            'xl': ['1.25rem', {
                lineHeight: '1.75rem',
            }],
            '2xl': ['1.5rem', {
                lineHeight: '2rem',
            }],
            '3xl': ['1.875rem', {
                lineHeight: '2.25rem',
            }],
            '4xl': ['2.25rem', {
                lineHeight: '2.5rem',
            }],
            '5xl': ['3rem', {
                lineHeight: '1',
            }],
            '6xl': ['3.75rem', {
                lineHeight: '1',
            }],
            '7xl': ['4.5rem', {
                lineHeight: '1',
            }],
            '8xl': ['6rem', {
                lineHeight: '1',
            }],
            '9xl': ['8rem', {
                lineHeight: '1',
            }],
        },
    },
    plugins: [require("daisyui")],
    daisyui: {
    themes: false,
    },
}
