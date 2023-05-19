<div class="overflow-y-scroll md:h-96 w-full">
    <div class="text-center text-sm ">
        APPLICATION FOR EMPLOYMENT, INCLUDING PROVISIONAL EMPLOYMENT
    </div>
    <div class="text-center mt-8 text-sm">
        <p>
        Required by the Child Protective Service Law 
        </p>
        <p>
        23 Pa. C.S. Section 6344 (relating to employees having contact with children; adoptive and foster parents)
        </p>
    </div>
    <div class="text-justify mt-8 text-xs h-32 break-normal w-full">
        <p class="break-words">
            I swear/affirm that, if providing certifications that have been obtained within the preceding 60 months, I have not been disqualified 
            from employment as outlined below or have not been convicted of an offense similar in nature to a crime listed below under the laws 
            or former laws of the United States or one of its territories or possessions, another state, the District of Columbia, the Commonwealth 
            of Puerto Rico or a foreign nation, or under a former law of this Commonwealth. 
        </p>
        </br>
        <p>
            I swear/affirm that I have not been named as a perpetrator of a founded report of child abuse within the past five (5) years as defined by the Child Protective Services Law. 
        </p>
        </br>
        <p>
            I swear/affirm that I have not been convicted of any of the following crimes under Title 18 of the  Pennsylvania consolidated statutes or equivalent crime under the laws or former laws of the United States or one of its territories or possessions, another state, the District of Columbia, the Commonwealth of Puerto Rico or a foreign nation, or under a former law of this Commonwealth. 
        </p>
        </br>
        <p>
            Chapter 25 (relating to criminal homicide) 
        </p>
        <p>
            Section 2702 (relating to aggravated assault) 
        </p>
        <p>
            Section 2709.1 (relating to stalking) 
        </p>
        <p>
            Section 2901 (relating to kidnapping) 
        </p>
        <p>
            Section 2902 (relating to unlawful restraint) 
        </p>
        <p>
            Section 3121 (relating to rape) 
        </p>
        <p>
            Section 3122.1 (relating to statutory sexual assault) 
        </p>
        <p>
            Section 3123 (relating to involuntary deviate sexual intercourse) Section 3124.1 (relating to sexual assault) 
        </p>
        <p>
            Section 3125 (relating to aggravated indecent assault) 
        </p>
        <p>
            Section 3126 (relating to indecent assault) 
        <p/>
        <p>
            Section 3127 (relating to indecent exposure) 
        </p>
        <p>
            Section 4302 (relating to incest) 
        </p>
        <p>
            Section 4303 (relating to concealing death of child) 
        </p>
        <p>
            Section 4304 (relating to endangering welfare of children) 
        </p>
        <p>
            Section 4305 (relating to dealing in infant children) 
        </p>
        <p>
            Section 5902(b) (relating to prostitution and related offenses) 
        </p>
        <p>
            Section 5903(c) (d) (relating to obscene and other sexual material and performances) Section 6301 (relating to corruption of minors) 
        </p>
        <p>
            Section 6312 (relating to sexual abuse of children), or an equivalent crime under Federal law or the law of another state. 
        </p>
        </br>
        <p>
            In addition to the crimes already outlined above, if I am an individual being employed in a child care  center, group child care home, 
            or family child care home, I swear/affirm that I have not been convicted of any of the following crimes under Title 18 of the Pennsylvania 
            consolidated statutes or equivalent crime under the laws or former laws of the United States or one of its territories or possessions, another state, 
            the  District of Columbia, the Commonwealth of Puerto Rico or a foreign nation, or under a former law of this Commonwealth.
        </p>
        </br>
        <p>
            Section 2718 (relating to strangulation) 
        </p>
        <p>
            Section 3301 (relating to arson and related offenses)
        </p>
        <p>
            18 U.S.C. Section 2261 (relating to interstate domestic violence) 
        </p>
        <p>
            18 U.S.C. Section 2262 (relating to interstate violation of protection order)
        </p>
        </br>
        <p>
            I swear/affirm that I have not been convicted of a felony offense under Act 64-1972 
            (relating to the controlled substance, drug device and cosmetic act) committed within the past five years. 
        </p>
        </br>
        <p>
            I understand that I must be dismissed from employment if I am named as a perpetrator of a founded report 
            of child abuse within the past five (5) years or have been convicted of any of the crimes listed above. 
        </p>
        </br>
        <p>
            I understand that if I am arrested for or convicted of an offense that would constitute grounds for denying 
            employment or participation in a program, activity or service under the Child Protective Services Law as listed above, 
            or am named as perpetrator in a founded or indicated report, I must provide the administrator or designee with written 
            notice not later than 72 hours after the arrest, conviction or notification that I have been listed as a perpetrator in the Statewide database. 
        </p>
        </br>
        <p>
            I understand that if the person responsible for employment decisions or the administrator of a program, 
            activity or service has a reasonable belief that I was arrested or convicted for an offense that would 
            constitute grounds for denying employment or participation in a program, activity or service under the  
            Child Protective Services Law, or was named as perpetrator in a founded or indicated report, or I have 
            provided notice as required under this section, the person responsible for employment decisions or 
            administrator of a program, activity or service shall immediately require me to submit current 
            certifications obtained through the Department of Human Services, the Pennsylvania State Police, 
            and the Federal Bureau of Investigation. The cost of certifications shall be borne by the employing 
            entity or program, activity or service.
        </p>
        </br>
        <p>
            I understand that if I willfully fail to disclose information required above, I commit a misdemeanor 
            of the third degree and shall be subject to discipline up to and including termination or denial of employment. 
        </p>
        </br>
        <p>
            I understand that certifications obtained for employment purposes may be used to apply for employment, 
            serve as an employee, apply to volunteer and serve as a volunteer.  
        </p>
        </br>
        <p>
            I understand that the person responsible for employment decisions or the administrator of a program, 
            activity or service is required to maintain a copy of my certifications. 
        </p>
        </br>
        <p>
            I hereby swear/affirm that the information as set forth above is true and correct. I understand that 
            false swearing is a misdemeanor pursuant to Section 4903 of the Crimes Code. 
        </p>
        @if ( !$disclosureAgreement['date_signed_disclosure_agreement'] ) 
        <div class="text-center mt-8 font-bold text-sm">
        <input type="checkbox" class="form-checkbox" wire:click="disclosureAgreement" wire:model="disclosureAgreementChecker"> By agreeing to this statement you are electronically consenting to this agreement. Do you accept the terms of this disclosure statement of employment?
        </div>
        @endif
    </div>
</div>