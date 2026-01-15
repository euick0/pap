import React from 'react';

interface ButtonProps {
    text: string;
    type: string;
}

const Button = ({text, type="primary"} : ButtonProps) => {
    

    return (
        <div>
            <button className="bg-accent px-3 py-2 rounded-xl m-0 transition duration-300 ease-in-out hover:bg-accentDark">{text}</button>
        </div>
    );
};

export default Button;