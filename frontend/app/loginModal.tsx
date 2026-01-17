import React from 'react';
import Button from "@/component/button";
import Image from "next/image";

interface LoginModalProps {
    onClose: () => void;
}

const LoginModal = ({onClose}: LoginModalProps) => {
    return (
        <div className="z-2 fixed top-0 left-0 w-screen h-screen bg-black/70 flex justify-center items-center">
            <div className="bg-gray-600 rounded-md w-8/12 h-8/12 relative flex overflow-hidden">
                    <Button type="secondary" content={
                        <Image src="/svgs/x.svg" width="30" height="30" alt="Close Login Modal Button"
                               className="transition duration-200 ease-in-out hover:invert-30 cursor-pointer absolute top-4 right-4"/>
                    } doOnClick={onClose}/>
                <div className="w-1/3 h-full bg-neutral-100 p-0 top-0 left-0 ">
                    <Image src="/images/japanese cafe.png" alt="Some image" width="500" height="500" className="object-cover"></Image>
                </div>
            </div>
        </div>
    );
};

export default LoginModal;
