# Jetmeshi
料理は面倒…、外食は高い…、でも栄養は摂りたい…、そんな需要を満たす最速フードを集めたサイトです。
みんなのアイデアを共有しましょう！
Cooking is a hassle...eating out is expensive...but I want to get nutrition...this is a site that collects the fastest food to meet such a demand.
Let's share everyone's ideas!

### Back borns
+ Language: PHP, JavaScript, SCSS, HTML
+ Framework: Laravel v7.7, Bootstrap
+ Tool: Circle CI, Docker, Adobe XD(wire frame), mermaid.js (sequence), Mailgun, Cloudflare
+ Infrastructure: AWS_lightsail, S3


### Login process
```mermaid
sequenceDiagram
participant U as User
participant Cl as Client
participant La as Laravel
participant DB as Data Base
participant Ml as Mailgun
    Note over U: Show up LOGIN form
    U ->>+ Cl: Http access
    Cl ->> Cl: Store cache
    Cl ->> La: Through req
    La -->> Cl: Returns form
    Cl -->>- U: Display form

alt success to login within 6 times
    U ->>+ Cl: LOGIN
    Cl ->>+ La: Validation
    alt is correct
        La-->>Cl: (nothing display)
        Cl ->> La: Through info
        La ->>+ DB: Through info
    else is wrong
        La-->>-Cl: Invalid format. Try again.
        Cl-->>U: Invalid format. Try again.
        U ->> U: back to LOGIN
    end

    alt is correct
        DB -->> Cl: Auth
        Cl-->> U: You logged in!
        Note over U: END LOGIN
    else is wrong
        DB -->>- Cl: Deny
        Cl-->>-U: Email or PW is wrong. Try again.
        U->>U: back to LOGIN
    end

    

else dnied 7 times
    DB -->>+ Cl: Lock account to keep secure
        Note over U: Reactivation
    U -x U: Incapable to LOGIN
    Cl -->>+ U: account has been locked
    U ->> Cl: Forgot PW req
    Cl ->> La: Forgot PW req
    La -->> Cl : Returns form
    Cl -->>- U: Display Forgot PW form
    
    U ->>+ Cl: Input Email and secret
    Cl ->>+ La: Validation
    alt is correct
        La ->> Cl: (nothing display)

        
    else is wrong
        La -->> Cl: Invalid format. Try again.
        Cl -->>- U: Invalid format. Try again.
        U ->> U: Back to Input Email & secret
    end
    
    Cl ->>+ La: Through info
    La ->> DB: Confirm
    DB -->> La: returns result

    alt is correct
        La ->> Ml: req to send PW
        Ml -->> U: send Email
        Note over U: End reactivation
    else is wrong
        La -->>- Cl : Email or Secret is wrong
        Cl -->> U: Email or Secret is wrong
        U ->>- U: Back to Input Email & secret
        
        end
end
```
### 


