import React from 'react';
import Logo from "@/component/logo";
import Button from "@/component/button";

const Header = () => {
    return (
        <div>
            <div className="flex justify-between px-8 py-5 m-5 items-center w-auto bg-gray-500/30 rounded-4xl">
                <Logo width={100} height={100}/>
                <Button text="smth""/>
            </div>
            
        </div>
    );
};

export default Header;