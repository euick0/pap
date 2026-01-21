'use server';

const RegisterHandler = async (formData: FormData) => {
    const email = formData.get("usernameOrEmail")
    const password = formData.get("password")
    const remember = formData.get("remember")

    console.log(password)
    console.log(email)
    console.log(remember)

};

export default RegisterHandler;
