import React from 'react';
import Button from "@/component/button";
import Image from "next/image";

interface LoginModalProps {
    onClose: () => void;
}

const LoginModal = ({onClose}: LoginModalProps) => {
    return (
        <div className="z-2 fixed top-0 left-0 w-screen h-screen bg-black/70 flex justify-center items-center">
            <div className="bg-backgroundLight border-complement1 border-3 rounded-md w-8/12 h-8/12 relative flex overflow-hidden">
                <div className="absolute w-0 h-0">
                    <Button type="secondary" content={
                        <Image src="/svgs/x.svg" width="20" height="20" alt="Close Login Modal Button"
                               className="transition duration-200 ease-in-out hover:invert-30 cursor-pointer absolute top-2 right-2"/>
                    } doOnClick={onClose}/>
                </div>
                <div className="w-5/12 h-full p-0 top-0 left-0">
                    <Image src="/images/person mountains.webp" alt="img.png" width="1499" height="1000" className="object-cover w-full h-full"></Image>
                </div>
                <div className="flex-1 flex-col flex">
                    <h1 className="text-center p-5 text-4xl antialiased font-semibold text-secondary">Log In</h1>
                    
                    <input type="text" className="bg-transparent rounded-sm border border-white placeholder-white"></input>
                    <input type="text" className="h-8 bg-transparent rounded-sm border border-white placeholder-white" placeholder=""></input>
                </div>
            </div>
        </div>
    );
};

export default LoginModal;
