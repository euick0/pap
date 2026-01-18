'use client';
import React, {useState} from 'react';
import Logo from "@/component/logo";
import Button from "@/component/button";
import HeroText from "@/app/heroText";
import LoginModal from "@/app/loginModal";

const Header = () => {
    const [isLoginModalOpen,setIsLoginModalOpen ] = useState(false);
    
    const ToggleLoginModal = () => {
        if(isLoginModalOpen){
            setIsLoginModalOpen(false);
        }
        else{
            setIsLoginModalOpen(true);
        }
    };

    return (
        <>
            {isLoginModalOpen && <LoginModal  onClose={ToggleLoginModal} />}
            <div className="relative w-screen h-screen overflow-hidden">
                <div className="flex justify-between px-8 py-3 m-5 items-center w-[98vw] bg-gray-500/30 rounded-4xl absolute z-1">
                    <div className="flex flex-1 items-center gap-4 justify-start">
                        <Logo width={100} height={100}/>
                    </div>
                    <div className="flex items-center gap-4">
                        <Button type="secondary" content="About us"/>
                        <Button type="secondary" content="Contact us"/>
                    </div>
                    <div className="flex flex-1 items-center gap-4 justify-end">
                        <Button type="secondary" content="Login" doOnClick={ToggleLoginModal}/>
                        <Button content="Register"/>
                    </div>
                </div>
                <div className="absolute">
                    <HeroText/>
                </div>
            </div>
        </>
    );
};

export default Header;