import React from 'react';
import Logo from "@/component/logo";
import Button from "@/component/button";
import HeroText from "@/app/heroText";

const Header = () => {
    return (
        <div>
            <div className="flex justify-between px-8 py-3 m-5 items-center w-auto bg-gray-500/30 rounded-4xl">
                <div className="flex flex-1 items-center gap-4 justify-start">
                    <Logo width={100} height={100}/>
                </div> 
                <div className="flex items-center gap-4">
                    <Button type="secondary" text="About us"/>
                    <Button type="secondary" text="Contact us"/>
                </div>
                <div className="flex flex-1 items-center gap-4 justify-end">
                    <Button type="secondary" text="Login"/>
                    <Button text="Register"/>
                </div>
            </div>
            <HeroText/>
        </div>
    );
};

export default Header;