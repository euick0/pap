'use server';

const RegisterHandler = async (formData: FormData) => {
    const email = formData.get("usernameOrEmail")
    const password = formData.get("password")
    const remember = formData.get("remember")
    const res = await fetch("http://localhost:8000/api/users")
    const data = await res.json()

    console.log(password)
    console.log(email)
    console.log(remember)
    console.log(data)

};

export default RegisterHandler;
