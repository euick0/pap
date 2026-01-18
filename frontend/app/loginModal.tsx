import React from 'react';
import Button from "@/component/button";
import Image from "next/image";

interface LoginModalProps {
    onClose: () => void;
}

const LoginModal = ({onClose}: LoginModalProps) => {
    return (
        <div className="z-2 fixed top-0 left-0 w-screen h-screen bg-black/70 flex justify-center items-center">
            <div className="bg-backgroundLight rounded-md w-8/12 h-8/12 relative flex overflow-hidden">
                <div className="w-0 h-0">
                    <Button type="secondary" content={
                        <Image src="/svgs/x.svg" width="25" height="25" alt="Close Login Modal Button"
                               className="transition duration-200 ease-in-out hover:invert-30 cursor-pointer absolute top-2 right-2 active:scale-105 active:duration-0"/>
                    } doOnClick={onClose}/>
                </div>
                <div className="w-5/12 h-full p-0 top-0 left-0">
                    <Image src="/images/person mountains.webp" alt="img.png" width="1499" height="1000" className="object-cover w-full h-full "></Image>
                </div>
                <div className="flex-1 flex-col flex justify-center">
                    <p className="ml-36 pt-0 mb-4 text-4xl antialiased font-semibold text-secondary text-stone-200">Log In</p>
                    <label className="antialiased ml-36 mt-5 mb-1 text--">Username or email</label>
                    <input type="text" className="h-10 text-lg bg-transparent rounded-lg border-2 border-neutral-400 placeholder-neutral-500 max-w-full mx-36 px-3" placeholder={"Enter your email/username"}></input>
                    <label className="antialiased ml-36 mt-5 mb-1 text--">Password</label>
                    <input type="password" className="h-10 text-lg bg-transparent rounded-lg border-2 border-neutral-400 placeholder-neutral-500 max-w-full mx-36 mb-5 px-3" placeholder="Enter your password"></input>
                    <div className="flex justify-between mx-36 mb-5">
                        <div className="flex items-center">
                                <input type="checkbox" className="size-3.5 min-m-auto"></input>
                            <label className="px-2 antialiased">Remember me</label>
                        </div>
                        <p className="text-blue-300 underline">Forgot Password?</p>
                    </div>
                    <div className="mx-36 max-w-full">
                        <Button content="Sign in" customCSS="w-full mb-2"/>
                        <Button content="Sign in with Google" customCSS="w-full bg-transparent border-1 border-border hover:bg-border!"/>
                    </div>

                </div>
            </div>
        </div>
    );
};

export default LoginModal;
