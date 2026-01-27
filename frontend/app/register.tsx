'use server';

const RegisterHandler = async (formData: FormData) => {
    const username = formData.get("username")
    const email = formData.get("email")
    const password = formData.get("password")
    const name = formData.get("name")
    const remember = formData.get("remember")
    const res = await fetch("http://localhost:8000/api/users")

    console.log(password)
    console.log(email)
    console.log(remember)

    const response = await fetch("http://localhost:8000/api/users", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({name: {name}, username: {username}, email: {email}, password:{password}}),
    });

    console.log(response)

};

export default RegisterHandler;
