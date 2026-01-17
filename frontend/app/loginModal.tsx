import React from 'react';
import Button from "@/component/button";
import Image from "next/image";

interface LoginModalProps{
    onClose: () => void;
}

const LoginModal = ({onClose}: LoginModalProps) => {
    return (
        <div className="z-2 fixed top-0 left-0 w-screen h-screen bg-black/70 flex justify-center items-center">
            <div className="bg-gray-600 rounded-md w-8/12 h-8/12">
                <div className="w-full flex justify-end p-1">
                    <Button type="secondary" content={
                      <Image src="/svgs/x.svg" width="30" height="30" alt="Close Login Modal Button" className="transition duration-200 ease-in-out hover:invert-30 cursor-pointer"/>
                    } doOnClick={onClose}/>

                </div>
            </div>
        </div>
    );
};

export default LoginModal;
