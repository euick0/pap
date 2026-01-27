import React, {useState} from 'react';
import Button from "@/component/button";
import Image from "next/image";
import RegisterHandler from "@/app/register";
import { useDebouncedCallback } from 'use-debounce';
import clsx from "clsx";

interface RegisterModalProps {
    onClose: () => void;
    onClickLogin: () => void;
}

const RegisterModal = ({onClose, onClickLogin}: RegisterModalProps) => {

    const [password, setPassword] = useState("")
    const [passwordInfo, setPasswordInfo] = useState("")

    const passwordValidation = useDebouncedCallback((input: string) =>{
        setPasswordInfo("")

        if (input.length < 8 && input != "") {
            setPasswordInfo("Password must be at least 8 characters long")
        }

    }, 150)

    const onPasswordChange = (input: string) => {
        setPassword(input)
        passwordValidation(input)
    };

    return (<div className="z-2 fixed top-0 left-0 w-screen h-screen bg-black/70 flex justify-center items-center">
        <div className="bg-backgroundLight rounded-md w-8/12 h-8/12 relative flex overflow-hidden">
            <div className="w-0 h-0">
                <Button style="secondary"
                        reactNode={<Image src="/svgs/x.svg" width="25" height="25" alt="Close Login Modal Button"
                                          className="transition duration-200 ease-in-out hover:invert-30 cursor-pointer absolute top-2 right-2 active:scale-105 active:duration-0"/>}
                        onClick={onClose}/>
            </div>
            <div className="w-5/12 h-full p-0 top-0 left-0">
                <Image src="/images/person mountains.webp" alt="img.png" width="1499" height="1000"
                       className="object-cover w-full h-full "></Image>
            </div>
            <form className="flex-1 flex-col flex justify-center" action={RegisterHandler}>
                <p className="ml-36 pt-0 text-4xl antialiased font-semibold text-secondary text-stone-200">Register</p>
                <label className="antialiased ml-36 mt-5 mb-1 text--">Username</label>
                <input type="text"
                       className="h-10 text-lg bg-transparent rounded-lg border-2 border-neutral-400 placeholder-white max-w-full mx-36 px-3"
                       placeholder=""
                       name="username"></input>
                <label className="antialiased ml-36 mt-5 mb-1 text--">Name</label>
                <input type="text"
                       className="h-10 text-lg bg-transparent rounded-lg border-2 border-neutral-400 placeholder-white max-w-full mx-36 px-3"
                       placeholder=""
                       name="name"></input>
                <label className="antialiased ml-36 mt-5 mb-1 text--">Email</label>
                <input type="email"
                       className="h-10 text-lg bg-transparent rounded-lg border-2 border-neutral-400 placeholder-white max-w-full mx-36 px-3"
                       placeholder=""
                       name="email"></input>
                <label className="antialiased ml-36 mt-5 mb-1 text--">Password</label>
                <input type="password"
                       className={clsx("h-10 text-lg bg-transparent rounded-lg border-2 border-neutral-400 placeholder-white max-w-full mx-36 px-3",{
                               "border-red-500 focus:border-red-600 focus:outline-none": passwordInfo != ""
                           }
                       )}
                       placeholder=""
                       value={password}
                       onChange={e => onPasswordChange(e.target.value)}
                       name="password"></input>
                <div className="mb-5"><p className=" ml-36 text-red-400">{passwordInfo}</p></div>
                <div className="mx-36 max-w-full mb-5">
                    <Button content="Register" customCSS="w-full mb-2" buttonType="submit"/>
                    <Button content="Continue with Google"
                            reactNode={<Image src="/svgs/Google Logo.svg" width="20" height="20" alt="Google Logo"
                                              className="m-full"></Image>}
                            customCSS="w-full bg-transparent border-1 border-border hover:bg-border! flex justify-center items-center gap-2"

                    />

                </div>
                <div className="mx-36 max-w-full mb-5 flex flex-row gap-1 justify-center items-center">
                    <p>Already have an account?</p> <Button content="Login" customCSS="text-blue-300 underline"
                                                            style="secondary" onClick={onClickLogin}></Button>
                </div>
            </form>
        </div>
    </div>);
};

export default RegisterModal;
